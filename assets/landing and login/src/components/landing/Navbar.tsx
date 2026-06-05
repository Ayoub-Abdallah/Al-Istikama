import { useState } from "react";
import { Menu, X, ChevronDown, Search } from "lucide-react";
import { Link } from "react-router-dom";

const navLinks = [
  { label: "Home", href: "#", hasDropdown: true },
  { label: "Programs", href: "#programs", hasDropdown: true },
  { label: "Scholars", href: "#scholars", hasDropdown: true },
  { label: "Events", href: "#events" },
  { label: "About", href: "#about" },
  { label: "Contact", href: "#contact" },
];

const Navbar = () => {
  const [mobileOpen, setMobileOpen] = useState(false);

  return (
    <nav className="bg-background/95 backdrop-blur-sm sticky top-0 z-50 border-b border-border shadow-sm">
      <div className="container mx-auto px-4 flex items-center justify-between h-20">
        <Link to="/" className="flex items-center gap-3">
          <div className="w-12 h-12 rounded-full bg-primary/20 flex items-center justify-center">
            <span className="text-primary font-heading text-xl font-bold">إ</span>
          </div>
          <div>
            <h1 className="text-foreground font-heading text-xl font-bold leading-tight">Istikama</h1>
            <p className="text-muted-foreground text-[10px] tracking-widest uppercase">Quranic Sciences Association</p>
          </div>
        </Link>

        <div className="hidden lg:flex items-center gap-8">
          {navLinks.map((link) => (
            <a
              key={link.label}
              href={link.href}
              className="text-foreground/80 hover:text-primary transition-colors text-sm font-medium flex items-center gap-1 group"
            >
              {link.label}
              {link.hasDropdown && (
                <ChevronDown className="w-3 h-3 group-hover:text-primary transition-colors" />
              )}
            </a>
          ))}
        </div>

        <div className="flex items-center gap-4">
          <button className="text-foreground/60 hover:text-primary transition-colors">
            <Search className="w-5 h-5" />
          </button>
          <button
            className="lg:hidden text-foreground"
            onClick={() => setMobileOpen(!mobileOpen)}
          >
            {mobileOpen ? <X className="w-6 h-6" /> : <Menu className="w-6 h-6" />}
          </button>
        </div>
      </div>

      {mobileOpen && (
        <div className="lg:hidden bg-background border-t border-border animate-fade-in">
          <div className="container mx-auto px-4 py-4 flex flex-col gap-3">
            {navLinks.map((link) => (
              <a
                key={link.label}
                href={link.href}
                className="text-foreground/80 hover:text-primary transition-colors text-sm font-medium py-2 border-b border-border/50"
                onClick={() => setMobileOpen(false)}
              >
                {link.label}
              </a>
            ))}
            <Link
              to="/login"
              className="text-primary text-sm font-medium py-2"
              onClick={() => setMobileOpen(false)}
            >
              Student Login
            </Link>
          </div>
        </div>
      )}
    </nav>
  );
};

export default Navbar;
