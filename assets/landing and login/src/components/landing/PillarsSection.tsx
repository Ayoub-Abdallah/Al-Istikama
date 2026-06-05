import pillarsBg from "@/assets/pillars-bg.jpg";

const pillars = [
  { icon: "☪", title: "Shahada", desc: "Declaration of Faith" },
  { icon: "🕌", title: "Salah", desc: "Five Daily Prayers" },
  { icon: "🌙", title: "Sawm", desc: "Fasting in Ramadan" },
  { icon: "🕋", title: "Hajj", desc: "Pilgrimage to Mecca" },
  { icon: "💰", title: "Zakat", desc: "Charitable Giving" },
];

const PillarsSection = () => (
  <section className="relative py-20 lg:py-28 overflow-hidden">
    <div className="absolute inset-0">
      <img
        src={pillarsBg}
        alt="Islamic architecture"
        className="w-full h-full object-cover"
        loading="lazy"
        width={1920}
        height={1080}
      />
      <div className="absolute inset-0 bg-dark-bg/85" />
    </div>

    <div className="relative z-10 container mx-auto px-4 text-center">
      <p className="section-subtitle text-lg mb-2">About Essential</p>
      <h2 className="section-title text-primary-foreground mb-4">Pillars of Islam</h2>
      <div className="golden-divider mb-14">
        <div className="golden-divider-dots">
          <span /><span /><span />
        </div>
      </div>

      <div className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6 lg:gap-8">
        {pillars.map((pillar, i) => (
          <div
            key={pillar.title}
            className="group animate-fade-in-up"
            style={{ animationDelay: `${i * 100}ms` }}
          >
            <div className="w-24 h-28 mx-auto mb-4 border-2 border-primary/40 rounded-t-full flex items-center justify-center text-4xl group-hover:border-primary group-hover:bg-primary/10 transition-all duration-300">
              {pillar.icon}
            </div>
            <h3 className="text-primary-foreground font-heading font-semibold text-lg mb-1">
              {pillar.title}
            </h3>
            <p className="text-primary-foreground/60 text-sm">{pillar.desc}</p>
          </div>
        ))}
      </div>
    </div>
  </section>
);

export default PillarsSection;
