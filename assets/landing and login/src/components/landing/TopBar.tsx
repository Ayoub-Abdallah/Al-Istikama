import { Mail, Phone } from "lucide-react";
import { Link } from "react-router-dom";

const TopBar = () => (
  <div className="bg-dark-bg border-b border-golden/20">
    <div className="container mx-auto px-4 py-2 flex flex-wrap items-center justify-between text-sm">
      <div className="flex items-center gap-4">
        <span className="text-primary-foreground/70">Follow Us:</span>
        <div className="flex gap-3">
          <a href="#" className="text-primary-foreground/60 hover:text-primary transition-colors">𝕏</a>
          <a href="#" className="text-primary-foreground/60 hover:text-primary transition-colors">f</a>
          <a href="#" className="text-primary-foreground/60 hover:text-primary transition-colors">▶</a>
        </div>
      </div>
      <div className="flex items-center gap-6">
        <a href="mailto:contact@istikama.org" className="flex items-center gap-2 text-primary-foreground/70 hover:text-primary transition-colors">
          <Mail className="w-4 h-4" />
          <span className="hidden sm:inline">contact@istikama.org</span>
        </a>
        <a href="tel:+00123345111" className="flex items-center gap-2 text-primary-foreground/70 hover:text-primary transition-colors">
          <Phone className="w-4 h-4" />
          <span className="hidden sm:inline">+(00) 123-345-11</span>
        </a>
        <Link to="/login" className="hidden md:inline-block border border-primary text-primary px-4 py-1 rounded hover:bg-primary hover:text-primary-foreground transition-all text-xs font-medium tracking-wider uppercase">
          Student Login
        </Link>
        <button className="bg-primary text-primary-foreground px-4 py-1 rounded hover:bg-golden-light transition-colors text-xs font-medium tracking-wider uppercase">
          Make Donation
        </button>
      </div>
    </div>
  </div>
);

export default TopBar;
