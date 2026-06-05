import { useState } from "react";
import serviceCommunity from "@/assets/service-community.jpg";
import serviceChildcare from "@/assets/service-childcare.jpg";
import serviceQuran from "@/assets/service-quran.jpg";
import serviceBuilding from "@/assets/service-building.jpg";

const services = [
  { title: "Community Service", image: serviceCommunity },
  { title: "Special Child Care", image: serviceChildcare },
  { title: "Quran Classes", image: serviceQuran },
  { title: "Building Upgrades", image: serviceBuilding },
];

const ServicesSection = () => {
  const [hovered, setHovered] = useState<number | null>(null);

  return (
    <section id="programs" className="py-20 lg:py-28 bg-background">
      <div className="container mx-auto px-4">
        <div className="text-center mb-14">
          <p className="section-subtitle text-lg mb-2">What We Offer</p>
          <h2 className="section-title text-foreground">Our Services</h2>
          <div className="golden-divider">
            <div className="golden-divider-dots">
              <span /><span /><span />
            </div>
          </div>
        </div>

        <div className="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
          {services.map((service, i) => (
            <div
              key={service.title}
              className="group cursor-pointer animate-fade-in-up"
              style={{ animationDelay: `${i * 150}ms` }}
              onMouseEnter={() => setHovered(i)}
              onMouseLeave={() => setHovered(null)}
            >
              <div className="relative overflow-hidden rounded-t-md">
                <img
                  src={service.image}
                  alt={service.title}
                  className="w-full h-52 object-cover transition-transform duration-500 group-hover:scale-110"
                  loading="lazy"
                  width={640}
                  height={512}
                />
                <div className="absolute inset-0 bg-primary/0 group-hover:bg-primary/20 transition-colors duration-300" />
              </div>
              <div
                className={`py-4 px-4 text-center font-heading font-semibold text-lg transition-all duration-300 rounded-b-md ${
                  hovered === i
                    ? "bg-primary text-primary-foreground"
                    : "bg-card text-card-foreground border border-t-0 border-border"
                }`}
              >
                {service.title}
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default ServicesSection;
