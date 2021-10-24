# Localio

Projet Tutoré: formation MIW

Localio est une plateforme de Click'n Collect. Elle liste sur une carte des commerçant pouvant chacun mettre en avant leur magasin (Photos, articles en vente) et ou les utilisateurs peuvent laisser leurs notes ainsi que des avis.

![alt text](./public/img/photos/localio.png)


# Lancer le projet :

`ddev start`

`ddev composer install`

`npm install`

`ddev exec php artisan migrate`

`ddev exec php artisan db:seed`

# Appliquer les styles :

`npm run dev`

# Passer en compte admin :

`ddev sequelace`

TABLE 'users', COLONE 'role_id', passer la valeur à:

- `3`: Modérateur (Modérer les demandes de compte commerçant et les avis laissés)
- `4`: Administrateur (Gérer les utilisateurs et leur statuts)
