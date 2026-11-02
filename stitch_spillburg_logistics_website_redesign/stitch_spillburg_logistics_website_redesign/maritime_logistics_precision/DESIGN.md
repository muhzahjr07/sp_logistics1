---
name: Maritime Logistics Precision
colors:
  surface: '#f7f9ff'
  surface-dim: '#d0dbe9'
  surface-bright: '#f7f9ff'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#edf4ff'
  surface-container: '#e4effd'
  surface-container-high: '#dee9f8'
  surface-container-highest: '#d8e4f2'
  on-surface: '#121d27'
  on-surface-variant: '#44474d'
  inverse-surface: '#27313c'
  inverse-on-surface: '#e7f2ff'
  outline: '#74777d'
  outline-variant: '#c4c6cd'
  surface-tint: '#4d6078'
  primary: '#000e1f'
  on-primary: '#ffffff'
  primary-container: '#10243a'
  on-primary-container: '#798ca6'
  inverse-primary: '#b5c8e5'
  secondary: '#2d638a'
  on-secondary: '#ffffff'
  secondary-container: '#9fd1fe'
  on-secondary-container: '#235a81'
  tertiary: '#170b00'
  on-tertiary: '#ffffff'
  tertiary-container: '#341f00'
  on-tertiary-container: '#bc7e19'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#d2e4ff'
  primary-fixed-dim: '#b5c8e5'
  on-primary-fixed: '#071c32'
  on-primary-fixed-variant: '#354860'
  secondary-fixed: '#cce5ff'
  secondary-fixed-dim: '#9accf8'
  on-secondary-fixed: '#001d31'
  on-secondary-fixed-variant: '#0a4b71'
  tertiary-fixed: '#ffddb5'
  tertiary-fixed-dim: '#ffb955'
  on-tertiary-fixed: '#2a1800'
  on-tertiary-fixed-variant: '#633f00'
  background: '#f7f9ff'
  on-background: '#121d27'
  surface-variant: '#d8e4f2'
typography:
  display-xl:
    fontFamily: Public Sans
    fontSize: 56px
    fontWeight: '700'
    lineHeight: 64px
    letterSpacing: -0.02em
  display-xl-mobile:
    fontFamily: Public Sans
    fontSize: 36px
    fontWeight: '700'
    lineHeight: 44px
    letterSpacing: -0.01em
  headline-lg:
    fontFamily: Public Sans
    fontSize: 40px
    fontWeight: '700'
    lineHeight: 48px
    letterSpacing: -0.015em
  headline-lg-mobile:
    fontFamily: Public Sans
    fontSize: 28px
    fontWeight: '700'
    lineHeight: 36px
    letterSpacing: -0.01em
  headline-md:
    fontFamily: Public Sans
    fontSize: 28px
    fontWeight: '600'
    lineHeight: 36px
    letterSpacing: -0.01em
  headline-sm:
    fontFamily: Public Sans
    fontSize: 20px
    fontWeight: '600'
    lineHeight: 28px
  title-md:
    fontFamily: Public Sans
    fontSize: 16px
    fontWeight: '600'
    lineHeight: 24px
  body-lg:
    fontFamily: Public Sans
    fontSize: 18px
    fontWeight: '400'
    lineHeight: 28px
  body-md:
    fontFamily: Public Sans
    fontSize: 15px
    fontWeight: '400'
    lineHeight: 22px
  body-sm:
    fontFamily: Public Sans
    fontSize: 13px
    fontWeight: '400'
    lineHeight: 18px
  label-lg:
    fontFamily: Public Sans
    fontSize: 14px
    fontWeight: '600'
    lineHeight: 20px
    letterSpacing: 0.02em
  label-md:
    fontFamily: Public Sans
    fontSize: 12px
    fontWeight: '600'
    lineHeight: 16px
    letterSpacing: 0.04em
  technical-code:
    fontFamily: Public Sans
    fontSize: 12px
    fontWeight: '500'
    lineHeight: 16px
    letterSpacing: 0.05em
rounded:
  sm: 0.125rem
  DEFAULT: 0.25rem
  md: 0.375rem
  lg: 0.5rem
  xl: 0.75rem
  full: 9999px
spacing:
  gutter: 1.5rem
  gutter-sm: 1rem
  margin: 2rem
  margin-sm: 1rem
  space-xs: 0.25rem
  space-sm: 0.5rem
  space-md: 1rem
  space-lg: 1.5rem
  space-xl: 2.5rem
  space-2xl: 4rem
---

## Brand & Style

This design system establishes an authoritative, institutional aesthetic engineered for global freight-forwarding and intermodal supply chain management. Drawing from maritime infrastructure, customs documentation, and commercial port terminal interfaces, the design language communicates structural reliability, operational precision, and corporate stature.

The visual style blends crisp modern corporate structure with utilitarian data legibility. Rather than playful or decorative flourishes, the system prioritizes structural alignment, unambiguous status signaling, and high-density information architecture. Key visual attributes include:
- Technical micro-labels and monospaced-style tabular metrics embedded within dense layout zones.
- Fine, structural division lines reminiscent of navigational charts and container terminal manifests.
- Restrained color application where dark oceanic hues form a stable institutional foundation, complemented by purposeful amber alerts for critical cargo waypoints and commercial calls to action.

## Colors

The palette reflects heavy maritime logistics and corporate governance. The system runs primarily in a high-contrast light mode, utilizing clean structural backgrounds framed by authoritative navy and maritime steel tones.

### Color Roles & Semantics
- **Deep Midnight Navy (`#10243A`)**: The primary anchor. Applied to top-level navigation bars, primary command buttons, authoritative headlines, and core institutional headers.
- **Industrial Blue (`#245B82`)**: The secondary foundation. Used for active vessel indicators, sub-navigation tabs, interactive freight links, secondary action outlines, and operational status accents.
- **Restrained Amber (`#E7A33E`)**: The functional accent. Reserved strictly for strategic transactional conversion points (e.g., "Request a Freight Quote"), customs clearance pending badges, live vessel delay notices, and transit warnings. Never applied to decorative large fills.
- **Graphite Charcoal (`#303B46` / `#1E2833`)**: Neutral dark. Used for high-legibility body prose, form field typography, and structural tabular data.
- **Subtle Cool Slate (`#E2E8F0`)**: Architectural divider color used across 1px card borders, table row dividers, and container bounds.
- **Neutral Light & White Surfaces (`#F7F8FA` / `#FFFFFF`)**: Canvas surface layers providing pristine negative space behind high-density logistics tables and freight calculators.

## Typography

The type system is powered by Public Sans, selected for its institutional precision, disciplined geometry, and exceptional legibility across dense logistics grids. 

### Typographic Hierarchy & Treatment
- **Display & Headlines**: Rendered with tight letter-spacing and firm vertical metrics. Used for major port statistics, intermodal service introductions, and corporate announcements.
- **Tabular Data & Technical Metrics**: Utilizing `font-variant-numeric: tabular-nums` across all route waypoints, TEU capacities, container codes (BIC/ISO 6346), bill of lading references, and exchange rates to ensure vertical alignment.
- **Labels & Microcopy**: Tracked outwards slightly (`letterSpacing: 0.02em - 0.05em`) in uppercase or small-caps styling for cargo status tags, IMO hazard labels, and terminal identification blocks.

## Layout & Spacing

The layout model is anchored by an engineering-grade 12-column grid system built for dense logistical tables, route configuration matrices, and multi-hub operational tracking.

### Grid & Breakpoints
- **Desktop (1200px+)**: 12 columns, 24px (`1.5rem`) gutters, 32px to 64px section margins. Provides stable multi-pane views (e.g., origin/destination calculator beside cargo spec sheets).
- **Tablet (768px - 1199px)**: 8 columns, 16px (`1rem`) gutters, 24px margins. Freight matrices compress into collapsible accordion panels or horizontally scrollable data sheets.
- **Mobile (< 768px)**: 4 columns, 16px gutters, 16px margins. Primary search, container tracking inputs, and single-column freight calculation workflows stack vertically.

### Spacing Principles
Spacing adheres to a strict 4px/8px rhythm. Padding within container manifests and input fields maintains a compact profile (`space-sm` to `space-md`) to optimize data visibility above the fold, while macro layout sections rely on `space-xl` and `space-2xl` to deliver corporate breathability.

## Elevation & Depth

In alignment with an institutional maritime aesthetic, this design system rejects heavy, blurry drop shadows in favor of **structural line boundaries and subtle tonal separation**.

### Depth Layers
- **Base Canvas (`Layer 0`)**: `#F7F8FA` provides a warm, grounded foundation for large portal pages.
- **Panel Surface (`Layer 1`)**: `#FFFFFF` bounded by a crisp 1px border (`#E2E8F0`). Used for cargo manifest cards, tracking filters, and rate calculators.
- **Elevated Interactive (`Layer 2`)**: Used exclusively for active modal dialogs, route selection dropdowns, and sticky tracking bars. Depth is created via an ultra-subtle, sharp shadow: `0 2px 4px rgba(16, 36, 58, 0.04), 0 8px 16px rgba(16, 36, 58, 0.08)`, combined with a 1px border (`#CBD5E1`).
- **Floating Urgent Overlay (`Layer 3`)**: Reserved for live vessel tracking alerts and customs warning notifications. Elevation is marked by an amber boundary bar (`2px` border-left in `#E7A33E`) over a pure white card.

## Shapes

The shape system leverages a restrained `roundedness: 1` standard (0.25rem / 4px base radius). This subtle soft corner eliminates aggressive sharpness while maintaining an industrial, technical quality derived from freight shipping containers, customs forms, and physical dispatch equipment.

### Radius Application Guidelines
- **Standard UI Elements (`4px`)**: Applied to standard text inputs, primary buttons, status badges, freight table container boxes, and tabs.
- **Card Containers (`8px / rounded-lg`)**: Applied to high-level modules such as rate calculator wrappers, hero inquiry cards, and tracking summary modules.
- **Pill Shapes (`9999px`)**: Prohibited for general buttons and inputs; strictly restricted to operational indicator dots and compact numeric badges (e.g., step counters).

## Components

### Buttons
- **Primary Action (Institutional Navy)**: Solid `#10243A` background, `#FFFFFF` text, 4px border radius. Hover state transitions to `#1E2833` with a subtle 1px internal border.
- **Accent Conversion (Quote / Urgent CTA)**: Solid `#E7A33E` background, `#10243A` bold text. Used exclusively for "Get a Quote", "Book Vessel", and primary dispatch submissions.
- **Secondary (Operational Blue)**: 1px border in `#245B82`, transparent background, `#245B82` text. Hover state fills with `#245B82` (10% opacity).
- **Tertiary / Utility**: Ghost button with `#303B46` text and hover underline; used for parent group navigation and document downloads.

### Input Fields & Selectors
- **Cargo Dimension & Route Fields**: Crisp `#FFFFFF` background with a 1px `#CBD5E1` border, 4px radius, 8px vertical padding. Focus state features a 1.5px `#245B82` outline without fuzzy blur rings.
- **Inline Tracking Search**: Heavy input field pairing a deep navy container prefix dropdown with a wide tracking ID input, terminated by a high-contrast `#10243A` or `#E7A33E` search trigger.

### Status Badges & Waypoint Chips
- **In-Transit / Underway**: Soft blue tint background (`#245B82` at 12%), `#245B82` text, 1px `#245B82` border (20% opacity), uppercase technical typography.
- **Customs Hold / Action Required**: Amber tint background (`#E7A33E` at 15%), `#8A560B` text, 1px `#E7A33E` border.
- **Vessel Berthed / Cleared**: Forest green tint background (`#15803D` at 12%), `#15803D` text.

### Logistics Cards & Table Manifests
- **Freight Rate Cards**: Crisp white surfaces bordered by `#E2E8F0`, featuring structured metadata rows (Port of Loading, Port of Discharge, Transit Time, Incoterms) separated by hair-thin horizontal dividers.
- **Tabular Cargo Manifest**: Strict alternating row fills (`#FFFFFF` and `#F8FAFC`), 1px structural table borders, bold technical headers with uppercase labeling, and tabular-spaced figures for volume, gross weight, and hazardous materials classifications.

### Specialized Maritime Components
- **Group Affiliation Bar**: A slim 32px top-strip anchored in `#0B1826` with understated link styling directing to the parent Spillburg corporate portal.
- **Multimodal Route Stepper**: Linear industrial progress indicator connecting Origin CFS, Sea Transit, Transshipment Hub, Port of Colombo, and Final Destination via solid 2px navy and dashed transit lines.