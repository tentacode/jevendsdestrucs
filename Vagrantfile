Vagrant.configure(2) do |config|
  config.vm.box = "debian/jessie64"
  config.vm.provision :shell, path: "provisioning/bootstrap.sh"
  #config.vm.network :forwarded_port, guest: 8000, host: 1337
  config.vm.network :private_network, ip: "192.168.33.43"
  config.vm.synced_folder ".", "/vagrant", id: "jevendsdestrucs",  :nfs => true, :mount_options => ['nolock,vers=3,udp,noatime,actimeo=1']
end
