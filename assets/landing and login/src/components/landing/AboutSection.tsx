import aboutMosque from "@/assets/about-mosque.jpg";

const AboutSection = () => (
  <section id="about" className="py-20 lg:py-28 geometric-pattern">
    <div className="container mx-auto px-4">
      <div className="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
        <div className="relative animate-fade-in-left">
          <div className="absolute -left-3 -top-3 w-full h-full border-2 border-primary rounded-sm" />
          <img
            src={aboutMosque}
            alt="Beautiful mosque"
            className="relative z-10 w-full h-[400px] lg:h-[480px] object-cover rounded-sm shadow-xl"
            loading="lazy"
            width={800}
            height={600}
          />
        </div>

        <div className="animate-fade-in-right">
          <p className="section-subtitle text-lg mb-2">Our History</p>
          <h2 className="section-title text-foreground mb-4">About Istikama</h2>
          <div className="golden-divider justify-start mb-6">
            <div className="golden-divider-dots">
              <span /><span /><span />
            </div>
          </div>
          <p className="text-muted-foreground leading-relaxed mb-4">
            We established our association to bring together the finest Quranic scholars and educators
            under one roof. Our multi-school system ensures students receive comprehensive education
            in Tajweed, Tafseer, Hadith, and Islamic jurisprudence from the ground up.
          </p>
          <p className="text-muted-foreground leading-relaxed mb-8">
            Visit our campuses across the region, where dedicated teachers guide students
            through a structured curriculum designed for all ages and levels.
          </p>
          <a
            href="#programs"
            className="inline-block bg-primary text-primary-foreground px-8 py-3 rounded font-medium tracking-wider uppercase text-sm hover:bg-golden-light transition-all hover:shadow-lg hover:shadow-primary/20"
          >
            Read More
          </a>
        </div>
      </div>
    </div>
  </section>
);

export default AboutSection;
