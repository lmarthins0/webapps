# portainer 

    docker swarm init --advertise-addr 192.168.0.95
    docker stack deploy -c portainer.yml portainer
    Acessar: http://192.168.0.95:9000/

    senha: portainer-agent-stack

    docker stack rm portainer
    docker volume rm portainer_portainer_data
