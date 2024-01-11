# Ejemplo realizado en clase

Lo clonáis o hacéis un fork

```bash
git clone https://github.com/MAlejandroR/bd.git
```
Una vez descargado lo primero creaís en **.env** a partir del fichero **env**

Podéis establecer las credenciales que queráis



Luego tenéis que orquestar con **composer**
Para crear el autoload y descargar la librería de **DotEnv**
```bash
composer update
```

Levantáis el contenedor
```bash
docker compose up -d
```


