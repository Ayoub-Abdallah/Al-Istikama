<?php

class __Mustache_8bd796ba63f957970f9e44d956792cea extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        $value = $context->find('error');
        $buffer .= $this->section042775cc8427e8c4a54ca9c89be11bba($context, $indent, $value);
        $value = $context->find('info');
        $buffer .= $this->sectionA6c5ff908f7a7bfcddf5e55d36f13882($context, $indent, $value);
        $buffer .= $indent . '
';
        $buffer .= $indent . '<div class="login-page active" id="login-page" style="display: flex;">
';
        $buffer .= $indent . '  <div class="login-left">
';
        $buffer .= $indent . '    <img src="/local/istikama_admin/pix/landing/istakama-banner.jpg" alt="Mosque at dusk">
';
        $buffer .= $indent . '    <div class="overlay"></div>
';
        $buffer .= $indent . '    <div class="content">
';
        $value = $context->find('istikama_logourl');
        $buffer .= $this->section0ac11ef3439154e5fa159067155cbf7d($context, $indent, $value);
        $value = $context->find('istikama_logourl');
        if (empty($value)) {
            
            $buffer .= $indent . '        <div class="logo-circle">إ</div>
';
        }
        $buffer .= $indent . '      <h1>Welcome to <span class="accent">Istikama</span></h1>
';
        $buffer .= $indent . '      <p>Your gateway to comprehensive Quranic sciences education. Join our multi-school association and begin your journey of knowledge.</p>
';
        $buffer .= $indent . '      <div class="golden-divider" style="margin-top:32px"><div class="golden-dots"><span></span><span></span><span></span></div></div>
';
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '  </div>
';
        $buffer .= $indent . '  <div class="login-right geometric-pattern">
';
        $buffer .= $indent . '    <div class="login-form fade-in-up">
';
        $buffer .= $indent . '      <div class="mobile-logo-login">
';
        $value = $context->find('istikama_compactlogourl');
        $buffer .= $this->section8e04a459aa2fd22ea648ef94dc2a7ca4($context, $indent, $value);
        $value = $context->find('istikama_compactlogourl');
        if (empty($value)) {
            
            $buffer .= $indent . '          <div class="logo-circle">إ</div>
';
        }
        $buffer .= $indent . '        <h2>Istikama</h2>
';
        $buffer .= $indent . '      </div>
';
        $buffer .= $indent . '      <h2>Student Login</h2>
';
        $buffer .= $indent . '      <p class="subtitle">Enter your credentials to access your dashboard</p>
';
        $buffer .= $indent . '      
';
        $buffer .= $indent . '      <form action="';
        $value = $this->resolveValue($context->find('loginurl'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '" method="POST" id="login">
';
        $buffer .= $indent . '        <input id="anchor" type="hidden" name="anchor" value="">
';
        $buffer .= $indent . '        <script>document.getElementById(\'anchor\').value = location.hash;</script>
';
        $buffer .= $indent . '        <input type="hidden" name="logintoken" value="';
        $value = $this->resolveValue($context->find('logintoken'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '">
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        <label>Username</label>
';
        $buffer .= $indent . '        <div class="input-wrap">
';
        $buffer .= $indent . '          <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
';
        $buffer .= $indent . '          <input type="text" name="username" id="username" value="';
        $value = $this->resolveValue($context->find('username'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '" placeholder="Username" required>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '        
';
        $buffer .= $indent . '        <label>Password</label>
';
        $buffer .= $indent . '        <div class="input-wrap">
';
        $buffer .= $indent . '          <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
';
        $buffer .= $indent . '          <input type="password" name="password" id="password" placeholder="••••••••" required>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '        
';
        $buffer .= $indent . '        <div class="options">
';
        $buffer .= $indent . '          <label><input type="checkbox" name="rememberusername" id="rememberusername"> Remember me</label>
';
        $buffer .= $indent . '          <a href="';
        $value = $this->resolveValue($context->find('forgotpasswordurl'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '">Forgot Password?</a>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '        
';
        $buffer .= $indent . '        <button type="submit" id="loginbtn" class="btn-submit">Sign In</button>
';
        $buffer .= $indent . '      </form>
';
        $buffer .= $indent . '
';
        $value = $context->find('cansignup');
        $buffer .= $this->sectionA7d08d947619aa50573c11bf903cb24a($context, $indent, $value);
        $buffer .= $indent . '      
';
        $buffer .= $indent . '      <div class="back-link"><a href="/">← Back to Home</a></div>
';
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '  </div>
';
        $buffer .= $indent . '</div>
';
        $buffer .= $indent . '
';
        $value = $context->find('js');
        $buffer .= $this->section088063b6b1af9bb6eae96f9d07a95be2($context, $indent, $value);

        return $buffer;
    }

    private function section042775cc8427e8c4a54ca9c89be11bba(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
    <div class="alert alert-danger" id="loginerrormessage" role="alert" style="position: absolute; width: 100%; top: 0; z-index: 100;">{{error}}</div>
';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '    <div class="alert alert-danger" id="loginerrormessage" role="alert" style="position: absolute; width: 100%; top: 0; z-index: 100;">';
                $value = $this->resolveValue($context->find('error'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '</div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionA6c5ff908f7a7bfcddf5e55d36f13882(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
    <div class="alert alert-info" id="logininfomessage" role="status" style="position: absolute; width: 100%; top: 0; z-index: 100;">{{info}}</div>
';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '    <div class="alert alert-info" id="logininfomessage" role="status" style="position: absolute; width: 100%; top: 0; z-index: 100;">';
                $value = $this->resolveValue($context->find('info'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '</div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section0ac11ef3439154e5fa159067155cbf7d(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
        <img src="{{istikama_logourl}}" alt="Istikama Logo" style="max-height: 80px; width: auto; margin-bottom: 24px; position: relative;">
      ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '        <img src="';
                $value = $this->resolveValue($context->find('istikama_logourl'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '" alt="Istikama Logo" style="max-height: 80px; width: auto; margin-bottom: 24px; position: relative;">
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section8e04a459aa2fd22ea648ef94dc2a7ca4(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
          <img src="{{istikama_compactlogourl}}" alt="Istikama Logo" style="max-height: 56px; width: auto; margin: 0 auto 8px auto;">
        ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '          <img src="';
                $value = $this->resolveValue($context->find('istikama_compactlogourl'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '" alt="Istikama Logo" style="max-height: 56px; width: auto; margin: 0 auto 8px auto;">
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionA7d08d947619aa50573c11bf903cb24a(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
      <p class="signup">Don\'t have an account? <a href="{{signupurl}}">Sign Up</a></p>
      ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '      <p class="signup">Don\'t have an account? <a href="';
                $value = $this->resolveValue($context->find('signupurl'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '">Sign Up</a></p>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section088063b6b1af9bb6eae96f9d07a95be2(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
    require([\'core_form/submit\'], function(Submit) {
        Submit.init("loginbtn");
    });
';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '    require([\'core_form/submit\'], function(Submit) {
';
                $buffer .= $indent . '        Submit.init("loginbtn");
';
                $buffer .= $indent . '    });
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
