# n8n Workflows

Production-tested [n8n](https://n8n.io) workflows for content automation, publishing and AI pipelines — cleaned up and released for anyone to import and adapt.

Every workflow here runs (or ran) in production first. They share the same discipline: **validate every AI output, retry with a limit, fail loudly instead of publishing something broken, and never let a model invent facts it wasn't given.**

---

## 🆓 Free workflows

| Workflow | What it does | Stack |
|---|---|---|
| **[WordPress AI Blog Autopilot](workflows/wordpress-ai-blog-autopilot)** | Picks a topic (no repeats), researches it, writes a 1,200–1,800 word post, generates a featured image, fills Rank Math SEO fields and publishes — with a category-specific CTA box at the end of every post. | OpenAI · Tavily · WordPress REST |
| **[Plant Shorts – Script & Image Generator](workflows/plant-shorts-script-generator)** *(lite)* | Turns a plant name into a source-checked fact sheet (Wikipedia + Tavily), a narrated short-video script and one 9:16 image per scene. | OpenAI · Tavily · Wikipedia API |
| **[Copyright-safe news images](https://github.com/S-Yucel/n8n-copyright-safe-news-images)** *(separate repo)* | Telegram → GPT-4o Vision → Flux → WordPress: publishes news articles with AI-generated featured images that never copy a source photo. | GPT-4o Vision · Flux · WordPress |

## 💎 Premium workflows

Full production versions, with setup support, are available at **[educattech.com](https://educattech.com)**:

| Workflow | What it does |
|---|---|
| **[Faceless Video Automation Suite](https://educattech.com/product/faceless-video-automation-suite/)** | Five end-to-end video pipelines — AI Shorts, daily niche videos, 3D character stories, cinematic AI animation and 10-minute narrated documentaries. Voice-over, clip generation, FFmpeg rendering and YouTube upload included. |
| **[Autonomous AI Journalist](https://educattech.com/product/autonomous-ai-journalist-wp-news-autoblog-bot/)** | Send a photo to Telegram, get a researched, SEO-structured WordPress article with your photo as the featured image. |
| **[CF7 Lead Generation & AI Scoring](https://educattech.com/product/cf7-lead-generation-ai-scoring-workflow-for-n8n/)** | Captures Contact Form 7 submissions, removes duplicates, scores intent with GPT-4, logs to Google Sheets and alerts you instantly. |
| **[FastAPI SaaS QA Pack](https://educattech.com/product/fastapi-saas-qa-pack-automated-n8n-testing-suite/)** | 30 automated nightly checks — auth, CRUD, public pages, end-to-end flow and security — with a colour-coded email report. |

Need something custom — n8n setup, a workflow built around your process, or AI agents? → **[educattech.com/services](https://educattech.com/services/)**

---

## 📥 How to import

1. Open the workflow folder and download `workflow.json`.
2. In n8n: **Workflows → Import from File** (or paste the JSON onto the canvas with Ctrl+V).
3. Add your credentials on each node that shows a warning.
4. Follow the setup section in that workflow's README.

Tested on self-hosted n8n 1.x. Community node used: [`@tavily/n8n-nodes-tavily`](https://www.npmjs.com/package/@tavily/n8n-nodes-tavily).

## License

[MIT](LICENSE) — use them, change them, sell what you build with them.
