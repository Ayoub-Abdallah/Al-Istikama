import { useState } from "react";
import { Droplets } from "lucide-react";
import donationBg from "@/assets/donation-bg.jpg";

const amounts = [50, 100, 150, 200];
const causes = [
  "Support Quran Memorization Programs",
  "Fund Scholarship for Underprivileged Students",
  "Build New Learning Centers",
  "Maintain and Upgrade Facilities",
];

const DonationSection = () => {
  const [selected, setSelected] = useState(1);

  return (
    <section className="relative">
      <div className="grid lg:grid-cols-2 min-h-[600px]">
        <div className="relative overflow-hidden">
          <img
            src={donationBg}
            alt="Charity work"
            className="absolute inset-0 w-full h-full object-cover"
            loading="lazy"
            width={1920}
            height={800}
          />
          <div className="absolute inset-0 bg-dark-bg/30" />
        </div>

        <div className="bg-background py-16 lg:py-20 px-8 lg:px-16">
          <p className="section-subtitle text-lg mb-2">Help Our Cause</p>
          <h2 className="section-title text-foreground mb-4">Make Your Donation</h2>
          <div className="golden-divider justify-start mb-8">
            <div className="golden-divider-dots">
              <span /><span /><span />
            </div>
          </div>

          <div className="flex flex-wrap gap-3 mb-8">
            {amounts.map((amount, i) => (
              <button
                key={amount}
                onClick={() => setSelected(i)}
                className={`px-6 py-3 rounded border-2 text-sm font-semibold transition-all ${
                  selected === i
                    ? "border-primary bg-primary text-primary-foreground"
                    : "border-border text-foreground hover:border-primary"
                }`}
              >
                ${amount}
              </button>
            ))}
          </div>

          <ul className="space-y-3 mb-8">
            {causes.map((cause) => (
              <li key={cause} className="flex items-start gap-3 text-muted-foreground">
                <Droplets className="w-4 h-4 text-primary mt-1 flex-shrink-0" />
                {cause}
              </li>
            ))}
          </ul>

          <h3 className="font-heading text-xl font-bold text-foreground">
            Educate & Empower Communities
          </h3>
        </div>
      </div>
    </section>
  );
};

export default DonationSection;
