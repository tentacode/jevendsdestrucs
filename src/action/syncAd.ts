import { Ad, SyncState } from "../domain/Ad";
import * as assert from "assert";
import { leboncoinCrawler } from "../crawler/Leboncoin";

function syncAd(ad: Ad) {
  assert.strictEqual(
    ad.syncState,
    SyncState.ToSync,
    'You can only sync ads with "To Sync" state.'
  );

  leboncoinCrawler.syncAd(ad);
}

export default syncAd;
