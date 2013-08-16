# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant::Config.run do |config|
  config.vm.box = "base"
  config.vm.network :hostonly, "10.11.12.13"
end

Vagrant.configure("2") do |config|
  config.vm.synced_folder ".", "/vagrant", :nfs => true
  config.vm.provider :virtualbox do |vb|
    vb.customize ["modifyvm", :id, "--memory", 512]
  end
end
