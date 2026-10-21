# WordPress AI Blog Autopilot

Publishes one researched, SEO-ready blog post per week to WordPress — and ends every post with a call-to-action box that matches its category.

```
Weekly Schedule
   └─ Topic Select ........ rotates through your categories (no category repeats until all are used)
   └─ Get Recent Titles ... last 60 published titles, so topics never repeat
   └─ Generate Topic ...... GPT-4.1 suggests one specific, search-friendly title
   └─ Search .............. Tavily research (non-fatal)
   └─ Prepare Brief ....... title + category + research in one clean item
   └─ Blog Writer ......... 1,200–1,800 words, fixed H2 structure, no invented statistics
   └─ Copywriter Agent → Create HTML → Title/Slug/Meta (structured output)
   └─ Prepare Post ........ cleans HTML, appends the CTA box, refuses to publish broken HTML
   └─ Create Draft Post ... created as DRAFT first
   └─ Featured image ...... gpt-image-1 → upload → attach (non-fatal)
   └─ SEO meta ............ excerpt + Rank Math title / description / focus keyword
   └─ Publish Post → Email notification
```

## Why it's built this way

- **Draft first, publish last.** Readers and Googlebot never see a post without its image or SEO fields.
- **No invented numbers.** The writer is told to use only statistics found in the research block — and that vague claims like "users report…" count as invented evidence too.
- **Research is data, not instructions.** Search results are wrapped in a `<research>` block the model is told never to obey (prompt-injection guard).
- **The model never writes sales copy.** CTA boxes come from your config, so every post links to the right offer without sounding like an ad.
- **Every non-critical step is non-fatal.** If Tavily, the image or the SEO step fails, the post is still published.

## Setup

1. **Import** `workflow.json` into n8n.
2. **Edit the CONFIG block** at the top of the *Topic Select* node:
   - `site_url`, `brand_name`, `brand_description`, `audience`, `quote_url`
   - `categories`: one entry per blog category with its `wp_category_id`, a `topic_prompt`, an `image_style` and a `cta` box.
     Find a category ID in WordPress under **Posts → Categories** — hover the category and read `tag_ID` in the link.
3. **Credentials:**
   - **WordPress** — your username + an [application password](https://wordpress.org/documentation/article/application-passwords/) (Users → Profile → Application Passwords). Select it on *Get Recent Titles*, *Create Draft Post* and every WordPress HTTP node.
   - **OpenAI** — on *Generate Topic*, *Blog Writer*, *Copywriter Model*, *Create HTML*, *Meta Model*, *Generate Featured Image*.
   - **Tavily** — on *Search* (free tier is enough for a weekly post). Install the community node `@tavily/n8n-nodes-tavily` first.
   - **SMTP** — on *Send Email Notification*, and change the from/to addresses.
4. **Rank Math (optional):** WordPress doesn't let the REST API write Rank Math fields by default. Upload [`wordpress/rank-math-rest-meta.php`](wordpress/rank-math-rest-meta.php) to `wp-content/mu-plugins/` (create the folder if needed). Without it, the SEO step is skipped silently and the post is still published.
5. **Test** with *Execute Workflow*, then activate. Change the day/time in *Weekly Schedule*.

> Category rotation is stored in n8n's workflow static data, which is only saved for production (active) executions — manual test runs don't advance it.

## API calls per post

5 OpenAI text calls, 1 `gpt-image-1` image and 1 Tavily search.

---

Want the photo-to-article version for news sites? See **[Autonomous AI Journalist](https://educattech.com/product/autonomous-ai-journalist-wp-news-autoblog-bot/)**.
