import { Ad } from "../domain/Ad";

const puppeteer = require("puppeteer-extra");
const pluginStealth = require("puppeteer-extra-plugin-stealth");
puppeteer.use(pluginStealth());

class LeboncoinCrawler {
  syncAd(ad: Ad): void {
    console.log("Syncing on leboncoin");

    (async () => {
      const browser = await puppeteer.launch();
      const page = await browser.newPage();
      await page.setViewport({ width: 800, height: 600 });

      await page.setUserAgent(
        "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:69.0) Gecko/20100101 Firefox/69.0"
      );
      await page.goto("https://www.leboncoin.fr");
      await page.waitFor(5000);
      await page.screenshot({ path: "testlbc.png", fullPage: true });

      await browser.close();
    })();
  }
}

export const leboncoinCrawler = new LeboncoinCrawler();
