const fs = require('fs');
const path = require('path');

const COMPONENTS = [
    "HeroSection",
    "AboutSection",
    "DonationSection",
    "ServicesSection",
    "PillarsSection",
    "BlogEventsSection",
    "Footer"
];

const ASSET_MAP = {
    "heroMosque": "assets/hero-mosque.jpg",
    "aboutMosque": "assets/about-mosque.jpg",
    "donationBg": "assets/donation-bg.jpg",
    "serviceQuran": "assets/service-quran.jpg",
    "serviceBuilding": "assets/service-building.jpg",
    "serviceCommunity": "assets/service-community.jpg",
    "serviceChildcare": "assets/service-childcare.jpg",
    "pillarsBg": "assets/pillars-bg.jpg",
    "blogMosque": "assets/blog-mosque.jpg",
    "blogQuran": "assets/blog-quran.jpg"
};

function convertTsxToHtml(content) {
    // Strip imports
    content = content.replace(/import .*?;\n/g, '');
    // Strip component wrapper
    content = content.replace(/const \w+ = \(\) => \(\s*/, '');
    content = content.replace(/\);\s*export default \w+;\s*/, '');
    // Replace variables for images
    for (const [varName, filePath] of Object.entries(ASSET_MAP)) {
        content = content.replace(new RegExp(`\\{${varName}\\}`, 'g'), `"${filePath}"`);
    }
    // Convert SVG camelCase
    content = content.replace(/strokeWidth/g, 'stroke-width');
    content = content.replace(/strokeLinecap/g, 'stroke-linecap');
    content = content.replace(/strokeLinejoin/g, 'stroke-linejoin');
    content = content.replace(/fillRule/g, 'fill-rule');
    content = content.replace(/clipRule/g, 'clip-rule');
    // Replace JSX classNames
    content = content.replace(/className=/g, 'class=');
    // Replace JSX comments
    content = content.replace(/\{\/\* (.*?) \*\/\}/g, '<!-- $1 -->');
    // React router links
    content = content.replace(/<Link to="(.*?)">(.*?)<\/Link>/g, '<a href="$1">$2</a>');
    // Self-closing divs/spans
    content = content.replace(/<span \/>/g, '<span></span>');
    content = content.replace(/<div \/>/g, '<div></div>');
    return content.trim();
}

const baseDir = path.join(__dirname, "landing and login/src/components/landing");
let htmlParts = [];
for (const comp of COMPONENTS) {
    const filePath = path.join(baseDir, `${comp}.tsx`);
    const content = fs.readFileSync(filePath, 'utf-8');
    htmlParts.push(`<!-- START ${comp} -->\n${convertTsxToHtml(content)}\n<!-- END ${comp} -->`);
}

const fullHtml = htmlParts.join("\n\n");

const outPath = path.join(__dirname, "moodle-ready-ui/landing.html");
fs.writeFileSync(outPath, fullHtml);
console.log("Conversion completed for Landing Page.");
