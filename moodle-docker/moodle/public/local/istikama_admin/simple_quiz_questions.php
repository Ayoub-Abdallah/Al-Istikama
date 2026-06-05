<?php
require_once('../../config.php');

$cmid = required_param('cmid', PARAM_INT);
redirect(new moodle_url('/mod/quiz/view.php', ['id' => $cmid]));
exit;

// Load questions via structure API (Moodle 5 compatible)
$quizobj = \mod_quiz\quiz_settings::create($cm->instance, $USER->id);
$structure = $quizobj->get_structure();
$slots = $structure->get_slots();

$totalmarks = 0;
$questionlist = [];

foreach ($slots as $slot) {
    // Get the question bank entry for this slot
    $qref = $DB->get_record('question_references', [
        'component' => 'mod_quiz',
        'questionarea' => 'slot',
        'itemid' => $slot->id
    ]);
    if (!$qref) continue;

    // Get the latest version of this question
    $qversion = $DB->get_record_sql(
        'SELECT qv.questionid, qv.version FROM {question_versions} qv
         WHERE qv.questionbankentryid = ? ORDER BY qv.version DESC',
        [$qref->questionbankentryid], IGNORE_MULTIPLE
    );
    if (!$qversion) continue;

    $question = $DB->get_record('question', ['id' => $qversion->questionid]);
    if (!$question || $question->qtype === 'description') continue;

    $totalmarks += $slot->maxmark;
    $icon = '❓';
    if ($question->qtype === 'multichoice') $icon = '🔘';
    if ($question->qtype === 'truefalse') $icon = '✅';

    $questionlist[] = [
        'id' => $question->id,
        'slotid' => $slot->id,
        'name' => format_string($question->name),
        'text' => format_text($question->questiontext, $question->questiontextformat, ['context' => $context]),
        'type' => $question->qtype,
        'icon' => $icon,
        'mark' => $slot->maxmark
    ];
}

// Ensure the quiz sumgrades is up to date
if (count($questionlist) > 0 && abs($quiz->sumgrades - $totalmarks) > 0.00001) {
    $DB->set_field('quiz', 'sumgrades', $totalmarks, ['id' => $quiz->id]);
    $quiz->sumgrades = $totalmarks;
}

$sesskeyjson = json_encode(sesskey());
$courseidjson = json_encode($cm->course);
$quizidjson = json_encode($quiz->id);
$cmidjson = json_encode($cm->id);
$questionsjson = json_encode($questionlist);

local_istikama_admin_print_header(get_string('sq_manage_prefix','local_istikama_admin') . format_string($quiz->name));
?>
<style>
.sq-container { max-width: 800px; margin: 0 auto; padding: 20px 0; }
.sq-card { background: #fff; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; margin-bottom: 24px; padding: 24px; }
.sq-header { margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; }
.sq-title { font-size: 20px; font-weight: 700; color: #0f172a; margin: 0; }
.sq-subtitle { font-size: 13px; color: #64748b; margin-top: 4px; }

.sq-qlist { display: flex; flex-direction: column; gap: 12px; margin-bottom: 24px; }
.sq-qitem { border: 1px solid #e2e8f0; border-radius: 8px; padding: 16px; background: #f8fafc; display: flex; gap: 16px; transition: all 0.2s; }
.sq-qitem:hover { border-color: #cbd5e1; box-shadow: 0 2px 4px rgba(0,0,0,0.02); }
.sq-qitem-icon { font-size: 24px; color: #3b82f6; display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: #eff6ff; border-radius: 8px; }
.sq-qitem-body { flex: 1; }
.sq-qitem-name { font-weight: 600; color: #1e293b; font-size: 14px; margin-bottom: 4px; }
.sq-qitem-text { font-size: 13px; color: #475569; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; }
.sq-qitem-meta { display: flex; gap: 12px; margin-top: 8px; font-size: 12px; color: #64748b; }
.sq-qitem-action { cursor: pointer; color: #ef4444; border: none; background: none; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600; transition: background 0.2s; }
.sq-qitem-action:hover { background: #fee2e2; }

.sq-tabs { display: flex; gap: 8px; margin-bottom: 16px; border-bottom: 2px solid #e2e8f0; }
.sq-tab { padding: 10px 16px; font-weight: 600; font-size: 14px; color: #64748b; border: none; background: none; border-bottom: 2px solid transparent; margin-bottom: -2px; cursor: pointer; transition: all 0.2s; }
.sq-tab:hover { color: #3b82f6; }
.sq-tab.active { color: #3b82f6; border-bottom-color: #3b82f6; }

.sq-panel { display: none; }
.sq-panel.active { display: block; }
.sq-form-group { margin-bottom: 16px; }
.sq-form-label { display: block; font-weight: 600; font-size: 13px; color: #334155; margin-bottom: 6px; }
.sq-input { width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 10px 12px; font-size: 14px; color: #1e293b; transition: border-color 0.2s; }
.sq-input:focus { outline: none; border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,0.1); }
.sq-input-error { border-color: #ef4444; }

.sq-choice-row { display: flex; gap: 12px; align-items: center; margin-bottom: 12px; }
.sq-choice-radio { width: 20px; height: 20px; accent-color: #22c55e; cursor: pointer; flex-shrink: 0; }
.sq-choice-text { flex: 1; }

.sq-btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 10px 20px; border-radius: 6px; font-weight: 600; font-size: 14px; border: none; cursor: pointer; transition: all 0.2s; }
.sq-btn-primary { background: #3b82f6; color: #fff; }
.sq-btn-primary:hover { background: #2563eb; transform: translateY(-1px); box-shadow: 0 4px 6px -1px rgba(59,130,246,0.2); }
.sq-btn-primary:disabled { background: #94a3b8; cursor: not-allowed; transform: none; box-shadow: none; }
.sq-btn-success { background: #22c55e; color: #fff; margin-top: 16px; }
.sq-btn-success:hover { background: #16a34a; box-shadow: 0 4px 6px -1px rgba(34,197,94,0.2); }

.sq-empty { text-align: center; padding: 32px 0; color: #64748b; }
.sq-empty-icon { font-size: 48px; margin-bottom: 12px; opacity: 0.5; }
.sq-marks-badge { background: #f1f5f9; padding: 6px 12px; border-radius: 20px; font-weight: 600; font-size: 13px; color: #475569; }
</style>

<div class="sq-container" id="sq-app">
    <!-- Quiz Header -->
    <div class="sq-card">
        <div class="sq-header" style="border:none; margin-bottom:0; padding:0;">
            <div>
                <a href="<?php echo (new moodle_url('/course/view.php', ['id' => $course->id]))->out(false); ?>" style="display:inline-block; margin-bottom:8px; font-size:13px; color:#3b82f6; text-decoration:none;">← Back to Course</a>
                <h2 class="sq-title">📝 <?php echo format_string($quiz->name); ?></h2>
                <div class="sq-subtitle"><?= get_string('sq_questions_in_quiz','local_istikama_admin') ?></div>
            </div>
            <div class="sq-marks-badge" id="sq-total-marks"><?= get_string('sq_total_points','local_istikama_admin') ?><?php echo $totalmarks; ?></div>
        </div>
    </div>

    <!-- Questions List -->
    <div class="sq-qlist" id="sq-question-list">
        <!-- Rendered via JS -->
    </div>

    <!-- Add Question Widget -->
    <div class="sq-card">
        <div class="sq-header">
            <h3 class="sq-title" style="font-size:16px;">➕ Add a New Question</h3>
        </div>

        <div class="sq-tabs">
            <button type="button" class="sq-tab active" data-tab="multichoice">🔘 <?= get_string('sq_tab_mc','local_istikama_admin') ?></button>
            <button type="button" class="sq-tab" data-tab="truefalse">👍 <?= get_string('sq_tab_tf','local_istikama_admin') ?></button>
        </div>

        <div class="sq-error-msg" id="sq-error-msg" style="color:#ef4444; font-size:13px; font-weight:600; margin-bottom:16px; display:none;"></div>

        <!-- Multiple Choice Form -->
        <div class="sq-panel active" id="sq-panel-multichoice">
            <div class="sq-form-group">
                <label class="sq-form-label"><?= get_string('sq_question_text','local_istikama_admin') ?> <span style="color:#ef4444">*</span></label>
                <textarea class="sq-input" id="sq-mc-text" rows="3" placeholder="<?= s(get_string('sq_ph_mc_text','local_istikama_admin')) ?>"></textarea>
            </div>
            
            <label class="sq-form-label" style="display:flex; justify-content:space-between;">
                <span><?= get_string('sq_answer_choices','local_istikama_admin') ?></span>
                <span style="color:#22c55e; font-weight:400; font-size:12px;"><?= get_string('sq_select_correct','local_istikama_admin') ?></span>
            </label>
            
            <div class="sq-form-group">
                <div class="sq-choice-row">
                    <input type="radio" name="sq-mc-correct" class="sq-choice-radio" value="0" checked>
                    <input type="text" class="sq-input sq-choice-text" id="sq-mc-choice-0" placeholder="<?= s(get_string('sq_ph_choice_a','local_istikama_admin')) ?>">
                </div>
                <div class="sq-choice-row">
                    <input type="radio" name="sq-mc-correct" class="sq-choice-radio" value="1">
                    <input type="text" class="sq-input sq-choice-text" id="sq-mc-choice-1" placeholder="<?= s(get_string('sq_ph_choice_b','local_istikama_admin')) ?>">
                </div>
                <div class="sq-choice-row">
                    <input type="radio" name="sq-mc-correct" class="sq-choice-radio" value="2">
                    <input type="text" class="sq-input sq-choice-text" id="sq-mc-choice-2" placeholder="<?= s(get_string('sq_ph_choice_c','local_istikama_admin')) ?>">
                </div>
                <div class="sq-choice-row">
                    <input type="radio" name="sq-mc-correct" class="sq-choice-radio" value="3">
                    <input type="text" class="sq-input sq-choice-text" id="sq-mc-choice-3" placeholder="<?= s(get_string('sq_ph_choice_d','local_istikama_admin')) ?>">
                </div>
            </div>
            
            <button type="button" class="sq-btn sq-btn-primary" id="sq-mc-submit"><?= get_string('sq_add_mc','local_istikama_admin') ?></button>
        </div>

        <!-- True/False Form -->
        <div class="sq-panel" id="sq-panel-truefalse">
            <div class="sq-form-group">
                <label class="sq-form-label"><?= get_string('sq_question_text','local_istikama_admin') ?> <span style="color:#ef4444">*</span></label>
                <textarea class="sq-input" id="sq-tf-text" rows="3" placeholder="<?= s(get_string('sq_ph_tf_text','local_istikama_admin')) ?>"></textarea>
            </div>
            <div class="sq-form-group">
                <label class="sq-form-label"><?= get_string('sq_correct_answer_is','local_istikama_admin') ?> <span style="color:#ef4444">*</span></label>
                <select class="sq-input" id="sq-tf-correct" style="width:200px;">
                    <option value="1"><?= get_string('sq_true','local_istikama_admin') ?></option>
                    <option value="0" selected><?= get_string('sq_false','local_istikama_admin') ?></option>
                </select>
            </div>
            <button type="button" class="sq-btn sq-btn-primary" id="sq-tf-submit"><?= get_string('sq_add_tf','local_istikama_admin') ?></button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var questions = <?php echo $questionsjson; ?>;
    var sesskey = <?php echo $sesskeyjson; ?>;
    var quizid = <?php echo $quizidjson; ?>;
    
    function renderList() {
        var listEl = document.getElementById('sq-question-list');
        var errEl = document.getElementById('sq-error-msg');
        errEl.style.display = 'none';
        
        listEl.innerHTML = '';
        if (questions.length === 0) {
            listEl.innerHTML = '<div class="sq-empty"><div class="sq-empty-icon">📭</div><div style="font-weight:600;"><?= s(get_string('sq_no_questions_yet','local_istikama_admin')) ?></div><div style="font-size:13px;margin-top:4px;"><?= s(get_string('sq_add_first','local_istikama_admin')) ?></div></div>';
            return;
        }
        
        var total = 0;
        questions.forEach(function(q, index) {
            total += parseFloat(q.mark);
            var h = '<div class="sq-qitem">' +
                '<div class="sq-qitem-icon">' + q.icon + '</div>' +
                '<div class="sq-qitem-body">' +
                    '<div class="sq-qitem-name">' + (index + 1) + '. ' + q.type.toUpperCase() + '</div>' +
                    '<div class="sq-qitem-text" title="' + q.text.replace(/"/g, '&quot;') + '">' + q.text + '</div>' +
                    '<div class="sq-qitem-meta">' +
                        '<span><?= s(get_string('sq_points_prefix','local_istikama_admin')) ?>' + q.mark + '</span>' +
                        '<span style="color:#cbd5e1">|</span>' +
                        '<button type="button" class="sq-qitem-action" onclick="window.sqDeleteQuestion(' + q.slotid + ')"><?= s(get_string('sq_remove','local_istikama_admin')) ?></button>' +
                    '</div>' +
                '</div>' +
            '</div>';
            listEl.insertAdjacentHTML('beforeend', h);
        });
        document.getElementById('sq-total-marks').textContent = <?= json_encode(get_string('sq_total_points','local_istikama_admin'), JSON_UNESCAPED_UNICODE) ?> + total;
    }
    
    // Tab logic
    document.querySelectorAll('.sq-tab').forEach(function(tab) {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.sq-tab').forEach(function(t) { t.classList.remove('active'); });
            document.querySelectorAll('.sq-panel').forEach(function(p) { p.classList.remove('active'); });
            this.classList.add('active');
            document.getElementById('sq-panel-' + this.dataset.tab).classList.add('active');
        });
    });
    
    function setSubmitting(btn, isSubmitting) {
        var errEl = document.getElementById('sq-error-msg');
        if (isSubmitting) {
            btn.dataset.original = btn.textContent;
            btn.textContent = <?= json_encode(get_string('sq_saving','local_istikama_admin'), JSON_UNESCAPED_UNICODE) ?>;
            btn.disabled = true;
            errEl.style.display = 'none';
        } else {
            btn.textContent = btn.dataset.original;
            btn.disabled = false;
        }
    }
    
    function submitQuestion(data, btn) {
        var errEl = document.getElementById('sq-error-msg');
        setSubmitting(btn, true);
        
        var body = new URLSearchParams();
        body.append('action', 'add_simple_question');
        body.append('sesskey', sesskey);
        body.append('quizid', quizid);
        for (var k in data) { body.append(k, data[k]); }
        
        fetch('/local/istikama_admin/ajax.php', {
            method: 'POST',
            body: body,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .then(function(r) { return r.json(); })
        .then(function(res) {
            if (res.error) {
                errEl.textContent = res.error;
                errEl.style.display = 'block';
                setSubmitting(btn, false);
                return;
            }
            // Success
            questions.push(res.question);
            renderList();
            setSubmitting(btn, false);
            
            // clear forms
            document.getElementById('sq-mc-text').value = '';
            document.getElementById('sq-mc-choice-0').value = '';
            document.getElementById('sq-mc-choice-1').value = '';
            document.getElementById('sq-mc-choice-2').value = '';
            document.getElementById('sq-mc-choice-3').value = '';
            document.getElementById('sq-tf-text').value = '';
            
        })
        .catch(function(e) {
            errEl.textContent = <?= json_encode(get_string('sq_network_error','local_istikama_admin'), JSON_UNESCAPED_UNICODE) ?>;
            errEl.style.display = 'block';
            setSubmitting(btn, false);
        });
    }

    // Submit Multiple Choice
    document.getElementById('sq-mc-submit').addEventListener('click', function() {
        var text = document.getElementById('sq-mc-text').value.trim();
        if (!text) { document.getElementById('sq-mc-text').classList.add('sq-input-error'); return; }
        document.getElementById('sq-mc-text').classList.remove('sq-input-error');
        
        var choices = [];
        for (var i = 0; i < 4; i++) {
            choices.push(document.getElementById('sq-mc-choice-' + i).value.trim());
        }
        var correctIndex = document.querySelector('input[name="sq-mc-correct"]:checked').value;
        
        if (!choices[0] || !choices[1]) {
            document.getElementById('sq-error-msg').textContent = <?= json_encode(get_string('sq_fill_two','local_istikama_admin'), JSON_UNESCAPED_UNICODE) ?>;
            document.getElementById('sq-error-msg').style.display = 'block';
            return;
        }

        submitQuestion({
            type: 'multichoice',
            questiontext: text,
            choices: JSON.stringify(choices),
            correct_index: correctIndex
        }, this);
    });

    // Submit True/False
    document.getElementById('sq-tf-submit').addEventListener('click', function() {
        var text = document.getElementById('sq-tf-text').value.trim();
        if (!text) { document.getElementById('sq-tf-text').classList.add('sq-input-error'); return; }
        document.getElementById('sq-tf-text').classList.remove('sq-input-error');
        
        var correct = document.getElementById('sq-tf-correct').value;

        submitQuestion({
            type: 'truefalse',
            questiontext: text,
            correct: correct
        }, this);
    });
    
    // Delete question handler
    window.sqDeleteQuestion = function(slotid) {
        if (!confirm(<?= json_encode(get_string('sq_confirm_remove','local_istikama_admin'), JSON_UNESCAPED_UNICODE) ?>)) return;
        
        var body = new URLSearchParams();
        body.append('action', 'delete_simple_question');
        body.append('sesskey', sesskey);
        body.append('quizid', quizid);
        body.append('slotid', slotid);
        
        fetch('/local/istikama_admin/ajax.php', {
            method: 'POST',
            body: body,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .then(function(r) { return r.json(); })
        .then(function(res) {
            if (res.error) { alert(res.error); return; }
            questions = questions.filter(function(q) { return q.slotid != slotid; });
            renderList();
        });
    };
    
    renderList();
});
</script>
<?php
local_istikama_admin_print_footer();
