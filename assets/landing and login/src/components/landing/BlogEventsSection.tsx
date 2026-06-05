import { Calendar, User, Clock, MapPin } from "lucide-react";
import blogQuran from "@/assets/blog-quran.jpg";
import blogMosque from "@/assets/blog-mosque.jpg";

const blogs = [
  {
    title: "Is Islam Old Philosophy?",
    date: "Jan 8, 2024",
    author: "Imam Abdullah",
    excerpt: "Islam is a comprehensive way of life that encompasses spiritual, moral, and social dimensions...",
    image: blogQuran,
  },
  {
    title: "Ulama Sermons with Audio",
    date: "Jan 5, 2024",
    author: "Sheikh Omar",
    excerpt: "Access our growing library of recorded sermons from renowned scholars across the globe...",
    image: blogMosque,
  },
];

const events = [
  { day: "28", month: "Nov", title: "World Scholars Meetup", location: "Main Campus", time: "9:30 am to 1:15 pm" },
  { day: "24", month: "Dec", title: "Modern Islam Challenges", location: "Main Campus", time: "9:30 am to 1:15 pm" },
  { day: "25", month: "Dec", title: "Islamic Teachings", location: "Main Campus", time: "9:30 am to 1:15 pm" },
];

const BlogEventsSection = () => (
  <section id="events" className="py-20 lg:py-28 bg-background geometric-pattern">
    <div className="container mx-auto px-4">
      <div className="text-center mb-14">
        <p className="section-subtitle text-lg mb-2">Event &amp; Blog</p>
        <h2 className="section-title text-foreground">Our Blog &amp; Events</h2>
        <div className="golden-divider">
          <div className="golden-divider-dots">
            <span /><span /><span />
          </div>
        </div>
      </div>

      <div className="grid lg:grid-cols-2 gap-12">
        {/* Blog Posts */}
        <div className="space-y-6">
          {blogs.map((blog) => (
            <div
              key={blog.title}
              className="flex flex-col sm:flex-row gap-5 group cursor-pointer animate-fade-in-left"
            >
              <div className="sm:w-56 flex-shrink-0 overflow-hidden rounded-md">
                <img
                  src={blog.image}
                  alt={blog.title}
                  className="w-full h-44 sm:h-full object-cover group-hover:scale-105 transition-transform duration-500"
                  loading="lazy"
                  width={640}
                  height={512}
                />
              </div>
              <div className="flex-1">
                <h3 className="font-heading font-bold text-xl text-foreground group-hover:text-primary transition-colors mb-2">
                  {blog.title}
                </h3>
                <div className="flex flex-wrap gap-4 text-sm text-muted-foreground mb-3">
                  <span className="flex items-center gap-1">
                    <Calendar className="w-3.5 h-3.5" /> {blog.date}
                  </span>
                  <span className="flex items-center gap-1">
                    <User className="w-3.5 h-3.5" /> {blog.author}
                  </span>
                </div>
                <p className="text-muted-foreground text-sm leading-relaxed mb-3">{blog.excerpt}</p>
                <a href="#" className="text-primary text-sm font-medium hover:underline">
                  View Details
                </a>
              </div>
            </div>
          ))}
        </div>

        {/* Events */}
        <div className="space-y-4 animate-fade-in-right">
          {events.map((event) => (
            <div
              key={event.title}
              className="flex items-start gap-5 p-5 rounded-lg border border-border hover:border-primary/30 hover:shadow-md transition-all duration-300 bg-card group cursor-pointer"
            >
              <div className="text-center flex-shrink-0">
                <span className="block text-3xl font-heading font-bold text-primary leading-none">
                  {event.day}
                </span>
                <span className="text-primary text-sm font-medium">{event.month}</span>
              </div>
              <div className="flex-1">
                <h3 className="font-heading font-bold text-lg text-foreground group-hover:text-primary transition-colors mb-2">
                  {event.title}
                </h3>
                <div className="flex flex-wrap gap-4 text-sm text-muted-foreground">
                  <span className="flex items-center gap-1">
                    <MapPin className="w-3.5 h-3.5 text-primary" /> {event.location}
                  </span>
                  <span className="flex items-center gap-1">
                    <Clock className="w-3.5 h-3.5 text-primary" /> {event.time}
                  </span>
                </div>
                <a href="#" className="text-muted-foreground text-sm font-medium hover:text-primary mt-2 inline-block transition-colors">
                  Event Details
                </a>
              </div>
            </div>
          ))}
        </div>
      </div>
    </div>
  </section>
);

export default BlogEventsSection;
