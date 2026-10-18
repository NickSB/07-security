# 07 – Security-Review

**KI erlaubt:** Ja, als Chat (z.B. um etwas nachzuschlagen). Du musst jede Lücke und jeden Fix **selbst erklären** können.

**Zeit:** ca. 3–4 Stunden

## Ausgangslage

Unsere Kundenverwaltung soll bald live gehen. Neu können **mehrere Mitarbeitende** damit arbeiten. Jede Person sieht und verwaltet nur **ihre eigenen Kunden**.

Die App funktioniert, aber niemand hat sie bisher auf Sicherheit geprüft. **Bevor die App live geht, machst du ein Security-Review.**

Vorhanden sind:
- Login (`/login`)
- Kundenliste (`/kunden`), Detailseite mit Notizen (`/kunden/{id}`), Bearbeiten (`/kunden/{id}/bearbeiten`)

## Starten

```bash
composer run setup   # erstellt die Datenbank mit zwei Benutzern und Testdaten
npm run dev
```

Dann http://07-security.test im Browser öffnen (Herd).

| Benutzer | E-Mail | Passwort |
|---|---|---|
| Anna Keller | `anna@bergsicht.example` | `passwort` |
| Ben Wyss | `ben@bergsicht.example` | `passwort` |

## Tipps zum Vorgehen

- Melde dich in **zwei Browsern** an (oder normales Fenster + Inkognito): einmal als Anna, einmal als Ben.
- Denk wie ein Angreifer: *Was passiert, wenn ich die URL ändere? Wenn ich etwas eingebe, das kein normaler Text ist?*
- Nutze die **Entwicklertools** (F12). In der Konsole kannst du mit `$wire` direkt auf die Livewire-Komponente der Seite zugreifen, z.B. `$wire.name` oder `$wire.save()`.
- Lies den Code in `resources/views/pages/` und `app/Models/`. Die meisten Lücken sieht man im Code schneller als im Browser.

---

## Aufgabe 7.1 – Lücken finden

Es gibt **mindestens 3** Sicherheitslücken. Dokumentiere jede Lücke in einer neuen Datei `SECURITY-REVIEW.md`:

```markdown
## Lücke 1: <kurzer Titel>
- **Wo:** Datei und Zeile
- **Was:** Was ist das Problem?
- **Ausnutzen:** Schritt für Schritt, wie ein Angreifer das nutzen kann
- **Risiko:** hoch / mittel / tief, mit Begründung
```

Wichtig: Beschreibe nur Lücken, die du **selbst ausprobiert** hast oder im Code eindeutig zeigen kannst.

## Aufgabe 7.2 – Lücken schliessen

Behebe alle Lücken, die du gefunden hast.

- Die App muss danach **für die rechtmässigen Benutzer genau gleich funktionieren**.
- Ergänze in `SECURITY-REVIEW.md` bei jeder Lücke einen Punkt **Fix:** mit dem, was du gemacht hast und warum das hilft.
- Mach pro Lücke einen eigenen Commit.

Nützliche Doku:
- Autorisierung / Policies: https://laravel.com/docs/authorization
- Livewire Security & Locked Properties: https://livewire.laravel.com/docs/security
- Blade-Ausgabe: https://laravel.com/docs/blade#displaying-data

## Aufgabe 7.3 – Zusatz: Tests

Schreibe für jede Lücke einen Feature-Test in `tests/Feature/`, der beweist, dass sie geschlossen ist. Der Test soll **vor** deinem Fix fehlschlagen und **danach** grün sein.

```bash
php artisan test
```

---

## Abgabe

Committe deine Arbeit und erkläre uns:
1. Welche Lücke findest du am gefährlichsten und warum?
2. Warum reicht es nicht, einen Button im HTML auszublenden?
3. Wie würdest du verhindern, dass solche Lücken in neuen Features wieder entstehen?
