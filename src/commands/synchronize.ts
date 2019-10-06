import { Command, flags } from "@oclif/command";
import handleAdsBySyncState from "../action/handleAdsBySyncState";
import { SyncState, Ad } from "../domain/Ad";
import syncAd from "../action/syncAd";

export default class Synchronize extends Command {
  static description = "Synchronize all ads";

  static examples = [`$ jvdt synchronize`];

  static flags = {
    help: flags.help({ char: "h" })
  };

  static args = [];

  async run() {
    const { args, flags } = this.parse(Synchronize);

    handleAdsBySyncState(SyncState.ToSync, syncAd);
  }
}
