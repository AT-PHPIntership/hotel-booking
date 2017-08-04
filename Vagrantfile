# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure("2") do |config|
  # The most common configuration options are documented and commented below.
  # For a complete reference, please see the online documentation at
  # https://docs.vagrantup.com.

  # Every Vagrant development environment requires a box. You can search for
  # boxes at https://vagrantcloud.com/search.
  config.vm.box = "ubuntu/xenial64"

  # Disable automatic box update checking. If you disable this, then
  # boxes will only be checked for updates when the user runs
  # `vagrant box outdated`. This is not recommended.
  # config.vm.box_check_update = false

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine. In the example below,
  # accessing "localhost:8080" will access port 80 on the guest machine.
  # NOTE: This will enable public access to the opened port
  config.vm.network "forwarded_port", guest: 80, host: 8080

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine and only allow access
  # via 127.0.0.1 to disable public access
  # config.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "127.0.0.1"

  # Create a private network, which allows host-only access to the machine
  # using a specific IP.
  config.vm.network "private_network", ip: "192.168.33.10"

  # Create a public network, which generally matched to bridged network.
  # Bridged networks make the machine appear as another physical device on
  # your network.
  # config.vm.network "public_network"

  # Share an additional folder to the guest VM. The first argument is
  # the path on the host to the actual folder. The second argument is
  # the path on the guest to mount the folder. And the optional third
  # argument is a set of non-required options.
  config.vm.synced_folder "../", "/home/ubuntu/web/"

  # Provider-specific configuration so you can fine-tune various
  # backing providers for Vagrant. These expose provider-specific options.
  # Example for VirtualBox:
  #
  # config.vm.provider "virtualbox" do |vb|
  #   # Display the VirtualBox GUI when booting the machine
  #   vb.gui = true
  #
  #   # Customize the amount of memory on the VM:
  #   vb.memory = "1024"
  # end
  #
  # View the documentation for the provider you are using for more
  # information on available options.

  # Enable provisioning with a shell script. Additional provisioners such as
  # Puppet, Chef, Ansible, Salt, and Docker are also available. Please see the
  # documentation for more information about their specific syntax and use.
  config.vm.provision "shell", privileged: false, inline: <<-SHELL
     sudo apt update
     sudo apt upgrade
     echo "INSTALL PHP7.0 AND PHP7.0 MODULE"
     sudo apt install -y php7.0 php7.0-cgi php7.0-curl php7.0-mysql php7.0-xml php7.0-json php7.0-mbstring php7.0-zip
     echo "INSTALL APACHE2"
     sudo apt install -y apache2
     sudo apt install -y libapache2-mod-php7.0
     echo "ENABLE APACHE2 REWITE MOD"
     sudo a2enmod rewrite
     sudo service apache2 restart
     echo "INSTALL COMPOSER"
     php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
     php -r "if (hash_file('SHA384', 'composer-setup.php') === '669656bab3166a7aff8a7506b8cb2d1c292f042046c5a994c43155c0be6190fa0355160742ab2e1c88d40d5be660b410') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
     sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
     php -r "unlink('composer-setup.php');"
     sudo chmod -R 777 .composer
     echo "INSTALL LARAVEL"
     composer global require "laravel/installer"
     echo 'export PATH="$PATH:$HOME/.composer/vendor/bin"' >> ~/.bashrc
     source ~/.bashrc
   
     echo "INSTALL MYSQL-SERVER"
     sudo apt-get install -y debconf-utils > /dev/null
     sudo debconf-set-selections <<< "mysql-server mysql-server/root_password password 1234"
     sudo debconf-set-selections <<< "mysql-server mysql-server/root_password_again password 1234"
     sudo apt install -y mysql-server > /dev/null 
     
     echo "INSTALL NPM"
     curl -sL https://deb.nodesource.com/setup_8.x | sudo -E bash -
     sudo apt-get install -y nodejs
     mkdir ~/.npm-global
     npm config set prefix '~/.npm-global'
     echo "export PATH=~/.npm-global/bin:$PATH" >> ~/.profile
     source ~/.profile  

     echo "INSTALL bower"
     npm install -g bower

     echo "INSTALL PHP-UNIT"
     wget https://phar.phpunit.de/phpunit.phar
     chmod +x phpunit.phar
     sudo mv phpunit.phar /usr/bin/phpunit
     sudo chown root:root /usr/bin/phpunit

  SHELL
end
