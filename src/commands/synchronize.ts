import {Command, flags} from '@oclif/command'

export default class Synchronize extends Command {
  static description = 'Synchronize all ads'

  static examples = [
    `$ jvdt synchronize`,
  ]

  static flags = {
    help: flags.help({char: 'h'}),
  }

  static args = []

  async run() {
    const {args, flags} = this.parse(Synchronize)

    this.log(`Synchronizing`)
    this.log(process.env.FOO)
  }
}
