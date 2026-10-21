# Plant Shorts – Script & Image Generator (Lite)

Turns a plant name into everything a short educational video needs — a **source-checked fact sheet**, a **narrated script** split into scenes, and **one 9:16 image per scene** — without letting the AI invent botany.

```
Run Manually / Weekly Schedule
   └─ Pick Plant .............. rotates through your plant list (no repeats)
   └─ Wikipedia Fetch ......... full article via the MediaWiki API
   └─ Wikipedia Guard ......... rejects disambiguation pages, wrong subjects (a car, a bird) and stubs
   └─ Fact Sheet Agent ........ Wikipedia first, Tavily only for gaps  ──┐
   └─ Validate Fact Sheet → OK? ── no → Retry Guard (max 2 retries) ─────┘
   └─ Resolve Chapter ......... stops if the fact sheet is too thin
   └─ Script Agent ............ uses ONLY the fact sheet, no research tool ──┐
   └─ Validate Script → OK? ── no → Retry Guard (max 2 retries) ─────────────┘
   └─ Split Snippets → Generate Snippet Image → Build Package
```

## Output

One item per scene (snippet), ready for your own TTS / video step:

| Field | Example |
|---|---|
| `video_title` | The Hidden World of the Snake Plant |
| `caption` | Description with hashtags and an AI-content disclosure |
| `script_number` | 1, 2, 3 … |
| `script_text` | 35–45 spoken words, one continuous story across snippets |
| `image_prompt` | Scene-specific prompt, a different shot for every snippet |
| `image_ok` + binary `data` | The generated 9:16 image |
| `full_narration` | All snippets joined, for single-file TTS |

## Why it's built this way

- **Wrong Wikipedia pages are common.** Many plant common names resolve to something else ("Lotus" → the car brand, "Bird of Paradise" → the bird). The guard checks title match, disambiguation markers and botanical vocabulary before the article is trusted, and the agent switches to Tavily when it isn't.
- **Hints are not facts.** Each plant row carries an editorial hint; the agent may only use it if a real source confirms it.
- **Health-claim discipline.** "Studied for effects on X" can never become "cures X".
- **The script writer has no research tool on purpose.** It may only use the validated fact sheet, so every spoken fact traces back to a source.
- **Validation with bounded retries.** Wrong snippet counts, missing image prompts or out-of-range word counts trigger a regeneration — at most 3 attempts, then the run stops with the exact reason.

## Setup

1. **Import** `workflow.json` into n8n and install the community node `@tavily/n8n-nodes-tavily`.
2. **Credentials:** OpenAI on *Fact Sheet Model*, *Script Model* and *Generate Snippet Image*; Tavily on *Search in Tavily*.
3. **Wikipedia Fetch:** put your own contact e-mail in the `User-Agent` header (Wikipedia's API policy asks for one).
4. **Pick Plant:** add your own plants to `PLANT_ROWS` and set `snippets` (scenes per video, default 3).
5. Click **Execute Workflow**. Then connect *Build Package* to your next step — TTS, a video renderer, Google Drive, a sheet…

> The rotation that prevents repeats is saved only for production (active) executions, not manual test runs.

## Lite vs. full version

This lite version stops at script + images. The production pipeline it comes from also generates the voice-over, animates each image into a clip, renders the final video with FFmpeg, uploads it to YouTube with the AI-content label set, and reports every run and error to Telegram. That full pipeline — plus four more video formats — is part of the **[Faceless Video Automation Suite](https://educattech.com/product/faceless-video-automation-suite/)**.
