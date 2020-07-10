# Pajarito

Pequeño plugin para Wordpress que crea el shortcode `[pajarito]` con el que resaltar texto y hacerlo clicable para twittear contenido de las entradas del blog.

## Instalación

- Copia la carpeta `pajarito` en `wp-content/plugins`.
- Desde el panel de administración de Wordpress, activa el plugin.
- En el menú lateral aparecerá un elemento `Pajarito` para acceder a las opciones.

## Uso

En el contenido de las entradas, redea el texto elegido con el shortcode `[pajarito]`:
```[pajarito]texto de la entrada que aparecerá resaltado y se twitteará[/pajarito]```

Puede añadirse uno o varios hashtags al tweet:
```[pajarito hashtag="UnHashtag OtroHashtag"]Algo de texto[/pajarito]```

Si no se indican hashtags, se añadirá por defecto el hashtag indicado en las opciones del plugin.

![Screenshot](https://raw.githubusercontent.com/bgonp/pajarito/master/screenshot.png)
