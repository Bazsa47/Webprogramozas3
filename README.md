# Webprogramozás3 beadandó

Az oldal alapvetően egy leegyszerűsített videójáték webáruházat valósít meg. A fő oldalon jelennek meg a termékek, ahol lehet képletesen rendelni. A termékek különböző adatai vannak feltűntetve, a tényleges szemmel olvasható adatokkal.
Az oldalon be lehet jelentkezni, amivel megnyílik előttünk a rendelés lehetősége. 
Regisztrációra is van lehetőség, minden regisztrált felhasználó user jogot kap, ezt csak az adatbázison belül lehet megváltoztatni.
Két felhasználói kör van:   -admin: képes a felhasználókat megtekinteni, törölni, módosítani, termékeket megtekinteni, törölni, módosítani, illetve hozzáadni, valamint megnézheti az eddigi rendeléseket. A rendelések törlődnek, ha a hozzájuk tartozó felhasználó vagy termék törlésre került, valamint a rendelések PDF formátumban letölthetőek.
  -user: csak megnézheti a termékeket, valamint rendelhet. A rendelésekhez és a felhasználókhoz nem fér hozzá.
  ha valaki nincs bejelentkezve, az user jogot sem kap. Ettől még látja a termékeket, de rendelni nem tud.
  Termék hozzáadásánál a kép megadása nem kötelező, ekkor egy alapméretezett kép fog megjelenni.
  A szükséges adatbázis táblákat és kezdő adatokat a create.sql tartalmazza. 
  
  
  
