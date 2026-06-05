import TopBar from "@/components/landing/TopBar";
import Navbar from "@/components/landing/Navbar";
import HeroSection from "@/components/landing/HeroSection";
import AboutSection from "@/components/landing/AboutSection";
import DonationSection from "@/components/landing/DonationSection";
import ServicesSection from "@/components/landing/ServicesSection";
import PillarsSection from "@/components/landing/PillarsSection";
import BlogEventsSection from "@/components/landing/BlogEventsSection";
import Footer from "@/components/landing/Footer";

const Index = () => (
  <div className="min-h-screen">
    <TopBar />
    <Navbar />
    <HeroSection />
    <AboutSection />
    <DonationSection />
    <ServicesSection />
    <PillarsSection />
    <BlogEventsSection />
    <Footer />
  </div>
);

export default Index;
