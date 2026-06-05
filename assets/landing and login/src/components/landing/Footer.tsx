import { Mail, Phone, MapPin } from "lucide-react";

const Footer = () => (
  <footer className="bg-dark-bg text-primary-foreground">
    <div className="container mx-auto px-4 py-16">
      <div className="grid sm:grid-cols-2 lg:grid-cols-4 gap-10">
        <div>
          <div className="flex items-center gap-3 mb-4">
            <div className="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center">
              <span className="text-primary font-heading text-lg font-bold">إ</span>
            </div>
            <h3 className="font-heading text-xl font-bold">Istikama</h3>
          </div>
          <p className="text-primary-foreground/60 text-sm leading-relaxed">
            A multi-school association dedicated to teaching Quranic sciences from the ground up.
          </p>
        </div>

        <div>
          <h4 className="font-heading font-semibold text-lg mb-4 text-primary">Quick Links</h4>
          <ul className="space-y-2 text-sm text-primary-foreground/60">
            {["Home", "Programs", "Scholars", "Events", "Contact"].map((link) => (
              <li key={link}>
                <a href="#" className="hover:text-primary transition-colors">{link}</a>
              </li>
            ))}
          </ul>
        </div>

        <div>
          <h4 className="font-heading font-semibold text-lg mb-4 text-primary">Programs</h4>
          <ul className="space-y-2 text-sm text-primary-foreground/60">
            {["Quran Memorization", "Tajweed", "Tafseer", "Hadith Studies", "Arabic Language"].map((item) => (
              <li key={item}>
                <a href="#" className="hover:text-primary transition-colors">{item}</a>
              </li>
            ))}
          </ul>
        </div>

        <div>
          <h4 className="font-heading font-semibold text-lg mb-4 text-primary">Contact Info</h4>
          <ul className="space-y-3 text-sm text-primary-foreground/60">
            <li className="flex items-start gap-2">
              <MapPin className="w-4 h-4 text-primary mt-0.5 flex-shrink-0" />
              123 Islamic Center Ave, City
            </li>
            <li className="flex items-center gap-2">
              <Phone className="w-4 h-4 text-primary flex-shrink-0" />
              +(00) 123-345-11
            </li>
            <li className="flex items-center gap-2">
              <Mail className="w-4 h-4 text-primary flex-shrink-0" />
              contact@istikama.org
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div className="border-t border-primary-foreground/10">
      <div className="container mx-auto px-4 py-5 text-center text-sm text-primary-foreground/40">
        © 2024 Istikama. All Rights Reserved.
      </div>
    </div>
  </footer>
);

export default Footer;
