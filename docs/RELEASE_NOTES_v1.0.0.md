# Release v1.0.0 — Production Release: Spillburg Logistics 1 Platform

**Release Date:** November 2026  
**Build:** `v1.0.0-stable`  
**License:** Proprietary — Spillburg Logistics 1 (Private) Limited  

---

### Highlights & Included Capabilities

#### 1. Public Digital Showcase & Service Hub
- **Multimodal Service Portals**: Dedicated operational briefs and specifications for:
  - Ocean Freight (FCL/LCL, Reefer, Carrier Slot Management)
  - Air Cargo (IATA Accredited, Express Expedited, ULD Containers)
  - Road Haulage (Prime Movers, Colombo Port Container Drayage, Multi-axle)
  - Project Cargo (Heavy Lift Engineering, Breakbulk, Route Surveys)
  - Licensed Sri Lanka Customs Brokerage (ASYCUDA World, BOI Schemes)
  - Bonded Warehousing & Buffer Staging
- **Port Advisory & Operational Ticker**: Live status alerts for Colombo Port terminals (JCT, CICT, SAGT, CWIT) and trade advisories.
- **Industry Solutions**: Dedicated sector pages for Apparel & Textiles, Industrial Machinery, FMCG, Cold Chain Logistics, and Energy.

#### 2. Commercial Request-for-Quote (RFQ) Engine
- 4-Step progressive disclosure wizard (`quote.php`).
- Automated generation of unique tracking dockets formatted `RFQ-SL1-YYYY-XXXX`.
- Built-in gross weight/volume auto-validation, Incoterms, and special cargo flags.
- Instant docket confirmation receipt view for clients.

#### 3. Administrative Operations Console (`/admin`)
- Real-time operational metric counters (Pending Quotes, Unread Messages, Active Bulletins).
- Complete RFQ lifecycle manager (`pending` &rarr; `reviewing` &rarr; `quoted` &rarr; `booked` &rarr; `archived`).
- Internal logistics operational notes for container booking, carrier allocations, and demurrage clauses.
- One-click CSV export of quotation records for ERP/Accounting ingestion.
- Port advisories CRUD publishing tool.
- Site settings manager for contact information and ticker content.

#### 4. Architecture & Security
- Universal PDO layer with automatic fallback between MySQL and high-concurrency SQLite WAL.
- CSRF protection, timing-safe token validation, prepared statements, and bcrypt authentication.

