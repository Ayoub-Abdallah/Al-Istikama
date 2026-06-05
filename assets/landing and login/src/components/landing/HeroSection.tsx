import heroMosque from "@/assets/hero-mosque.jpg";

const HeroSection = () => (
  <section className="relative min-h-[85vh] flex items-center justify-center overflow-hidden">
    <div className="absolute inset-0">
      <img
        src={heroMosque}
        alt="Beautiful mosque at night"
        className="w-full h-full object-cover"
        width={1920}
        height={1080}
      />
      <div className="absolute inset-0 bg-gradient-to-b from-dark-bg/70 via-dark-bg/50 to-dark-bg/80" />
    </div>

    <div className="relative z-10 text-center px-4 max-w-4xl mx-auto">
      <div className="golden-divider mb-6 animate-fade-in">
        <div className="golden-divider-dots">
          <span /><span /><span />
        </div>
      </div>

      <h1 className="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-heading font-bold text-primary-foreground mb-6 animate-fade-in-up leading-tight">
        Know the Path of
        <br />
        <span className="text-primary">Quranic Sciences</span>
      </h1>

      <div className="golden-divider mb-8 animate-fade-in animation-delay-200">
        <div className="golden-divider-dots">
          <span /><span /><span />
        </div>
      </div>

      <p className="text-primary-foreground/80 text-lg md:text-xl max-w-2xl mx-auto mb-10 animate-fade-in-up animation-delay-400 font-body leading-relaxed">
        When things are too hard to handle, retreat &amp; count your blessings instead.
        Join Istikama's multi-school association for comprehensive Quranic education.
      </p>

      <a
        href="#about"
        className="inline-block bg-primary text-primary-foreground px-8 py-3 rounded font-medium tracking-wider uppercase text-sm hover:bg-golden-light transition-all hover:shadow-lg hover:shadow-primary/20 animate-fade-in-up animation-delay-600"
      >
        Read More
      </a>
    </div>

    <div className="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-background to-transparent" />
  </section>
);

export default HeroSection;
