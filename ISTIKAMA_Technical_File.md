# ISTIKAMA

## Centralized Educational Management Platform

### Empowering Schools with Intelligent Administration, Digital Learning & Academic Excellence

**Version 1.0 · 2025**

---

## Introduction

Istikama is a centralized educational management platform designed to streamline the complete lifecycle of school operations — from organizational structure and user enrollment to digital content delivery, academic assessment, and parent engagement.

Purpose-built for private school networks, Istikama unifies administration, pedagogy, and communication into a single, intuitive platform. It eliminates the need for fragmented tools by providing role-based dashboards for every stakeholder: **Super Administrators**, **Editors**, **School Managers**, **Teachers**, **Students**, and **Parents**.

Whether you are operating a single institution or coordinating across a regional network of schools, Istikama adapts to your organizational model and scales with your growth — supporting up to **500 schools**, **10,000 users**, and **5,000 digital content items** from a single deployment.

---

## Key Features

### Multi-Tenant School Management
Manage multiple schools, academic levels, classes, and subjects from a unified console. Each institution operates with full data isolation while sharing centralized resources such as the digital library and question banks.

### Role-Based Access & Dashboards
Seven distinct user roles — each with a purpose-built dashboard — ensure that every user sees exactly what they need. From system-wide KPIs for administrators to daily class views for teachers, every interaction is tailored and efficient.

### Moderated Digital Library
A comprehensive content repository supporting Documents, Videos, Interactive Content (H5P), Books, Quizzes, and External Links. All content passes through a structured review and approval workflow before reaching students, ensuring academic quality and consistency.

### Intelligent Assessment Engine
Create, manage, and deploy assessments using a centralized question bank organized by level and subject. A simplified quiz builder allows teachers to assemble evaluations in minutes, while editors maintain quality through a moderation pipeline.

### Real-Time Attendance & Behavior Tracking
Record daily attendance (Present, Absent, Late, Excused) alongside behavioral observations. Data is instantly available to school managers and parents, enabling timely intervention and follow-up.

### Comprehensive Reporting & Analytics
Four-tier reporting (System, School, Teacher, Student) powered by interactive charts and data visualizations. AI-assisted insights surface student strengths, weaknesses, and engagement patterns to inform academic decisions.

### Parent Engagement Portal
A dedicated portal where parents track grades, attendance, and behavior across multiple children. Direct communication with school staff keeps families informed and involved in their children's academic journey.

### Full Localization
Native support for **Arabic** (with full RTL layout), **English**, and **French** — ensuring accessibility for diverse user communities.

---

## System Architecture

Istikama follows a modular, three-tier architecture designed for reliability, performance, and ease of deployment.

```
┌──────────────────────────────────────────────────────────────────────┐
│                        ISTIKAMA PLATFORM                             │
│                                                                      │
│  ┌────────────────┐   ┌────────────────┐   ┌─────────────────────┐  │
│  │   Web Client   │   │  Mobile Client │   │   Parent Portal     │  │
│  │   (Browser)    │   │  (Responsive)  │   │   (Responsive Web)  │  │
│  └───────┬────────┘   └───────┬────────┘   └──────────┬──────────┘  │
│          │                    │                        │             │
│          └────────────────────┼────────────────────────┘             │
│                               │                                      │
│                    ┌──────────▼──────────┐                           │
│                    │   Application Core  │                           │
│                    │   PHP 8.2 Engine    │                           │
│                    │   RESTful API Layer │                           │
│                    │   AJAX Web Services │                           │
│                    └──────────┬──────────┘                           │
│                               │                                      │
│          ┌────────────────────┼────────────────────┐                 │
│          │                    │                    │                  │
│  ┌───────▼────────┐  ┌───────▼────────┐  ┌───────▼────────┐        │
│  │  MySQL 8.4     │  │  File Storage  │  │  Session Cache │        │
│  │  Database      │  │  (Content &    │  │  (Optional     │        │
│  │  (Core + 16    │  │   Media Files) │  │   Redis)       │        │
│  │  Custom Tables)│  │                │  │                │        │
│  └────────────────┘  └────────────────┘  └────────────────┘        │
└──────────────────────────────────────────────────────────────────────┘
```

**Frontend Layer** — A custom-built interface using the proprietary `isti-*` design system delivers a modern, responsive experience. AJAX-driven interactions provide a single-page-application feel with instant page updates and zero full-page reloads.

**Application Layer** — The PHP 8.2 backend manages all business logic, role-based access control, API endpoints, and integrations with the underlying LMS engine. Over 40 API actions handle everything from school hierarchy management to content moderation workflows.

**Data Layer** — MySQL 8.4 with a custom extended schema of 16 specialized tables manages complex relationships — content ratings, threaded discussions, multi-school user assignments, attendance records, and academic assessments — all with strict data isolation between institutions.

---

## Main Functions

### 1. User Management

Istikama provides complete lifecycle management for all platform users — from creation and role assignment to school enrollment and permission control.

| Function | Description |
| :--- | :--- |
| **User Creation** | Add users individually or via bulk import with automatic role assignment |
| **Role Assignment** | Assign one of 7 predefined roles with granular capability control |
| **School Enrollment** | Map users to specific schools, levels, and classes |
| **Teacher-Subject Binding** | Assign teachers to specific subjects with automatic course enrollment |
| **Parent-Child Linking** | Connect parent accounts to one or more student profiles |
| **Permission Management** | 12+ custom capabilities control precise read/write access per module |

**Supported Roles:**

| Role | Description | Key Permissions |
| :--- | :--- | :--- |
| **Super Admin** | Platform-wide administrator | Full access to all modules and settings |
| **Editor** | Technical content reviewer | Question bank, quiz management, content moderation |
| **School Manager** | Institution-level administrator | Users, content, reports, notifications for assigned school |
| **Teacher** | Classroom instructor | Class library, attendance, grades, content creation |
| **Student** | Enrolled learner | Course access, assessments, personal reports |
| **Parent** | Guardian/family member | Child tracking, academic reports, messaging |
| **Support Agent** | Technical helpdesk | Ticket management, user assistance |

---

### 2. School & Organizational Structure

Istikama models the complete educational hierarchy using a flexible, nested structure that mirrors real-world school organizations.

| Level | Description | Example |
| :--- | :--- | :--- |
| **School** | Top-level institution | Istikama Academy — Algiers |
| **Academic Level** | Grade/year group within a school | 1st Year Middle School |
| **Class** | Individual section within a level | Class 1-A |
| **Subject** | Taught discipline within a class | Mathematics, Arabic Language |
| **Lesson** | Individual teaching unit within a subject | Chapter 3: Fractions |

**Key Capabilities:**
- **Dynamic Hierarchy Management** — Add, edit, and reorganize schools, levels, and classes through an intuitive tree view with collapsible navigation.
- **Global Academic Levels** — Define standardized level structures that can be applied consistently across all institutions.
- **Bulk Subject Assignment** — Assign multiple subjects to a level at once; the platform automatically provisions the corresponding course structures.
- **Geographic Metadata** — Enrich school profiles with location data (Wilaya, Commune, Address) for regional analytics and compliance.
- **Institutional Branding** — Upload school logos for branded dashboards and navigation headers.
- **Academic Season Management** — Configure academic calendars and semester structures per institution.

---

### 3. Digital Library

The Digital Library is Istikama's centralized repository for all educational resources. It supports a rich variety of content types and enforces academic quality through a structured moderation pipeline.

**Supported Content Types:**

| Type | Description |
| :--- | :--- |
| **Document** | PDF, Word, and text-based teaching materials |
| **Video** | Recorded lectures, tutorials, and demonstrations |
| **H5P Interactive** | Rich interactive content (drag & drop, quizzes, presentations) |
| **Book** | Multi-chapter structured digital textbooks |
| **Quiz** | Assessment-ready question sets linked to the question bank |
| **External Link** | Curated web resources and third-party educational tools |

**Content Categories:** Main Resources · Explanatory Materials · Enrichment Content

**Moderation Workflow:**

All content passes through a structured, multi-stage approval pipeline:

```
Draft → Pending Review → Under Study → Approved → Published → Featured
                ↘ Needs Revision (returned to author with feedback)
                ↘ Rejected (with reason)
```

Each status transition is logged and attributed, providing a complete audit trail of content governance.

**Additional Features:**
- **Quality Ratings** — Dual-axis rating system (Usefulness and Design) on a 5-star scale
- **Threaded Discussions** — Nested comment threads on each content item for collaborative review
- **Smart Tagging** — Keyword-based tagging for efficient search and categorization
- **Lesson Linking** — Directly associate content items with specific lessons and classes
- **Level & Subject Filtering** — Browse and search content by academic level, subject, and category

---

### 4. Assignments & Activities

Teachers can create, distribute, and manage educational activities directly from their dashboard, with full integration into the class and subject structure.

| Function | Description |
| :--- | :--- |
| **Activity Creator** | Simplified wizard for building assignments with embedded questions |
| **Question Types** | Multiple choice, true/false, and more via the question bank |
| **Lesson Integration** | Link activities directly to specific lessons within a subject |
| **Status Workflow** | Draft → Active → Completed lifecycle for each activity |
| **Class Distribution** | Assign activities to specific classes or entire levels |

---

### 5. Assessments & Grading

Istikama provides a unified assessment framework that combines quiz-based evaluation with manual grading capabilities.

**Quiz Management:**
- **Centralized Question Bank** — A global repository of reusable questions, organized by academic level and subject. Editors curate and moderate question quality before making them available to teachers.
- **Simplified Quiz Builder** — Teachers select questions from the bank and assemble quizzes using an intuitive drag-and-drop interface with configurable marks per question.
- **Question Moderation** — All contributed questions pass through an approval pipeline (Pending → Approved / Rejected / Reported) to maintain assessment integrity.

**Grading & Scores:**

| Function | Description |
| :--- | :--- |
| **Score Entry** | Record individual student scores per subject and assessment |
| **Maximum Score Configuration** | Define max scores per assessment for accurate percentage calculation |
| **Notes & Observations** | Attach qualitative comments to each grade entry |
| **Grade History** | Complete historical record of all assessments per student |
| **Automatic Aggregation** | Platform computes averages and trends across subjects and periods |

---

### 6. Attendance & Behavior

A comprehensive daily tracking system that captures both attendance and behavioral observations for each student.

| Status | Icon | Description |
| :--- | :--- | :--- |
| **Present** | ✅ | Student attended the session |
| **Absent** | ❌ | Student did not attend |
| **Late** | ⏰ | Student arrived after the session started |
| **Excused** | 📋 | Absence justified by parent or administration |

**Behavior Notes:** Teachers can attach free-text behavioral observations to any attendance record, which are immediately visible to school managers and parents.

---

### 7. Parent Follow-Up

The Parent Portal provides families with continuous visibility into their children's academic lives.

| Function | Description |
| :--- | :--- |
| **Multi-Child Support** | Parents with multiple enrolled children switch between profiles seamlessly |
| **Grade Dashboard** | View scores, averages, and trends across all subjects |
| **Attendance History** | Full calendar view of attendance records with behavioral notes |
| **Direct Messaging** | Communicate with teachers and school administrators |
| **Academic Reports** | Access downloadable performance summaries per child |

---

### 8. Reports & Analytics

Istikama delivers actionable insights through a four-tier reporting architecture, each calibrated to the needs of its audience.

| Report Level | Audience | Key Metrics |
| :--- | :--- | :--- |
| **System Reports** | Super Admin | Platform-wide KPIs, school rankings, content analytics, user growth |
| **School Reports** | School Manager | Login trends, teacher activity, content usage, enrollment stats |
| **Teacher Reports** | Teachers | Student summaries, lesson engagement, assessment results |
| **Student Reports** | Students & Parents | Grades, progress curves, engagement scores, AI-driven insights |

**Visualization Engine:** Interactive charts and graphs powered by Chart.js, including bar charts, line graphs, doughnut charts, and trend indicators.

**AI-Assisted Insights:** The platform surfaces intelligent observations such as:
- Identification of weak and strong subjects per student
- Engagement pattern analysis (login frequency, content interaction)
- Early warning indicators for at-risk students

---

### 9. Support & Helpdesk

A built-in ticketing system for technical support and platform assistance.

| Feature | Description |
| :--- | :--- |
| **Ticket Creation** | Users submit issues with subject, description, and severity level |
| **Severity Levels** | Low · Normal · High — enabling triage and prioritization |
| **Status Tracking** | Open → In Progress → Resolved → Closed |
| **Admin Dashboard** | Centralized view of all tickets with filtering and bulk actions |

---

### 10. Notifications

School-level notification management allows school managers to broadcast announcements and alerts to their institutional community.

---

## Performance & Capacity

| Parameter | Specification |
| :--- | :--- |
| **Maximum Schools** | Up to 500 institutions per deployment |
| **Maximum Users** | Up to 10,000 concurrent user accounts |
| **Content Library Capacity** | Up to 5,000 digital content items |
| **Question Bank** | Up to 20,000 reusable questions |
| **Attendance Records** | Unlimited (daily records per student per class) |
| **Assessment Records** | Unlimited (per student per subject) |
| **Support Tickets** | Unlimited |
| **File Upload Limit** | Configurable per content type (default: 256 MB) |
| **Concurrent Sessions** | Limited by server resources; recommended 500+ simultaneous |
| **API Throughput** | 40+ AJAX action endpoints for real-time operations |
| **Languages Supported** | 3 (Arabic with RTL, English, French) |

---

## System Requirements

### Server Requirements

| Component | Minimum | Recommended |
| :--- | :--- | :--- |
| **Operating System** | Ubuntu 20.04 LTS / CentOS 8 | Ubuntu 22.04 LTS |
| **Web Server** | Apache 2.4 | Nginx with reverse proxy + SSL |
| **PHP Version** | 8.1 | 8.2 |
| **Database** | MySQL 8.0 | MySQL 8.4 |
| **RAM** | 4 GB | 8 GB+ |
| **Storage** | 50 GB | 200 GB+ (SSD recommended) |
| **Cache (Optional)** | — | Redis for session and application caching |
| **Containerization** | Docker 20.x / Docker Compose v2 | Latest stable Docker with orchestration |

### Client Requirements

| Component | Specification |
| :--- | :--- |
| **Browser** | Chrome 90+, Firefox 88+, Safari 14+, Edge 90+ |
| **Screen Resolution** | Minimum 1280×720 · Recommended 1920×1080 |
| **Mobile Access** | Responsive web interface (iOS Safari, Android Chrome) |
| **Internet** | Stable broadband connection (minimum 2 Mbps) |

---

## Deployment Options

| Model | Description |
| :--- | :--- |
| **Docker Compose** | Containerized deployment with pre-configured application and database services. Ideal for rapid provisioning and development environments. |
| **Bare Metal / VM** | Traditional server installation on physical or virtual machines with Apache/Nginx, PHP, and MySQL. |
| **Cloud Hosted** | Deployable on AWS, GCP, Azure, or any VPS provider. Supports managed database services and object storage (S3-compatible) for media files. |

---

## Security & Compliance

| Measure | Implementation |
| :--- | :--- |
| **Authentication** | Secure session-based authentication with CSRF token protection |
| **Authorization** | Granular, capability-based permission model with 12+ custom permissions |
| **Data Isolation** | Strict school-level data scoping — users access only their institutional data |
| **Input Validation** | Server-side parameter validation on all endpoints |
| **SQL Protection** | Parameterized queries via database abstraction layer |
| **XSS Prevention** | Automatic output escaping in all rendered templates |
| **File Security** | Type-restricted uploads with server-side validation |
| **Transport Security** | SSL/TLS encryption recommended for all deployments |

---

## Custom Theme & Design System

Istikama ships with a custom-designed interface theme that replaces the default LMS experience entirely.

| Aspect | Details |
| :--- | :--- |
| **Design System** | Proprietary `isti-*` CSS utility framework |
| **Base Framework** | Bootstrap 4 (extended and customized) |
| **Total Custom Styling** | 6,800+ lines across 3 dedicated stylesheets |
| **RTL Support** | Full Arabic right-to-left layout support |
| **Navigation** | Role-aware, dynamically generated navigation menus |
| **Branding** | Per-school logo and color theming in dashboard headers |
| **Responsive Design** | Fully responsive across desktop, tablet, and mobile viewports |

---

## Summary

Istikama is a complete, production-ready educational management platform that brings together school administration, digital content delivery, academic assessment, and family engagement into one cohesive system.

Built for the specific needs of private school networks, it delivers:

- ✅ **Unified Management** — One platform for schools, users, content, and assessments
- ✅ **Quality Assurance** — Moderated content and question banks maintain academic standards
- ✅ **Actionable Intelligence** — AI-assisted analytics turn data into educational insights
- ✅ **Inclusive Access** — Full Arabic RTL support with trilingual localization
- ✅ **Enterprise Security** — Strict data isolation, granular permissions, and audit-ready workflows
- ✅ **Scalable Architecture** — From a single school to a network of 500 institutions

---

*Istikama Platform · Version 1.0 · 2025*
*All specifications subject to change. Actual performance depends on deployment configuration and infrastructure.*
