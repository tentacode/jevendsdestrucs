import { Ad, SyncState } from "../domain/Ad";
import { RecordFields } from "../domain/Airtable";

function handleAdsBySyncState(syncState: SyncState, handler: (ad: Ad) => void) {
  const base = require("airtable").base(process.env.AIRTABLE_BASE);

  base(process.env.AIRTABLE_TABLE)
    .select({
      view: "list",
      filterByFormula: `{${RecordFields.SyncState}} = '${syncState}'`
    })
    .eachPage(
      function page(records: [], fetchNextPage: () => void) {
        records.forEach(function(record: any) {
          const ad: Ad = Ad.fromRecord(record);

          handler(ad);
        });

        fetchNextPage();
      },
      function done(err: Error) {
        if (err) {
          console.error(err);
          return;
        }
      }
    );
}

export default handleAdsBySyncState;
