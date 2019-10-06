enum SyncState {
  Draft = "Draft",
  ToSync = "To Sync",
  Synced = "Synced",
  ToDelete = "To Delete",
  Deleted = "Deleted",
  Sold = "Sold"
}

class Ad {
  constructor(
    readonly title: string,
    readonly description: string,
    readonly syncState: SyncState
  ) {
    this.title = title;
    this.description = description;
    this.syncState = syncState;
  }

  static fromRecord(record: any): Ad {
    return new Ad(
      record.get("title"),
      record.get("description"),
      record.get("sync_state")
    );
  }
}

export { Ad, SyncState };
