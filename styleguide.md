Styleguide: FamilienPlaner
Dieses Dokument definiert die visuellen Design-Richtlinien für die gesamte Anwendung. Alle von der Gemini CLI generierten Komponenten müssen diesen Regeln folgen, um ein konsistentes Erscheinungsbild zu gewährleisten.

1. Farben (Tailwind CSS)
Primärfarbe (Primary): Indigo für Aktionen, Links und aktive Zustände.

bg-primary-600 (Standard)

hover:bg-primary-700 (Hover-Effekt)

text-primary-600 (Textfarbe)

Neutraltöne (Slate): Für Text, Hintergründe und Ränder.

bg-slate-100 (Seitenhintergrund)

bg-white (Karten- und Container-Hintergrund)

text-slate-900 (Primärer Text, sehr hoher Kontrast)

text-slate-700 (Sekundärer Text, z.B. Überschriften)

text-slate-500 (Tertiärer Text, z.B. Labels)

border-slate-200 (Trenner und Ränder)

Akzentfarben für Mahlzeiten: Helle, freundliche Farben zur Unterscheidung.

Frühstück: Sky (bg-sky-200, text-sky-900)

Mittagessen: Amber (bg-amber-200, text-amber-900)

Abendessen: Emerald (bg-emerald-200, text-emerald-900)

2. Typografie
Schriftart: 'Inter', sans-serif.

Überschrift (Groß): text-xl font-bold text-slate-900

Überschrift (Mittel): text-lg font-semibold text-slate-800

Standard-Text: font-medium oder font-semibold, text-sm, text-slate-900

Label / Kleiner Text: text-xs font-semibold text-slate-500

3. Komponenten
Buttons

Primär-Button (Floating Action Button):

Klasse: bg-primary-600 text-white rounded-full flex items-center justify-center shadow-lg hover:bg-primary-700 transition-transform hover:scale-110

Größe: w-14 h-14

Standard-Button (z.B. in Formularen):

Klasse: px-4 py-2 bg-primary-600 text-white font-semibold rounded-lg shadow-sm hover:bg-primary-700

Karten (Cards)

Standard-Stil: Weißer Hintergrund, abgerundete Ecken, leichter Schatten.

Klasse: bg-white p-2.5 rounded-lg border border-slate-200 shadow-sm

Formular-Elemente

Input-Felder:

Klasse: w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500

Labels:

Klasse: block text-sm font-medium text-slate-700 mb-1

4. Layout & Abstände
Allgemeiner Abstand (Padding): p-4 oder p-6 für Seiteninhalte.

Abstand zwischen Elementen (Gap): gap-4 in Grid-Layouts.

Abstand innerhalb von Komponenten (Space): space-y-4 für vertikale Abstände.

5. Icons
Icon-Bibliothek: Phosphor Icons (<i class="ph ph-icon-name"></i>).

Standard-Stil: text-lg oder text-2xl.

Aktiver Stil (z.B. in Navigation): ph-fill verwenden, um das Icon zu füllen.