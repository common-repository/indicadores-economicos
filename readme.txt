=== WP Indicadores Economicos ===
Plugin URI: http://www.andresmolina.net
Contributors: Andres Molina
Tags: chile,economicos,indicadores,uf,dolar
Requires at least: 2.8
Tested up to: 2.8.3
Stable tag: 0.3

Muestra los indicadores economicos para chile

== Description ==

WP Indicadores economicos Muestra los indicadores economicos para Chile.
Ahora más rápido, almacena los datos en la cache local del servidor, conectandose solo 1 vez al dia al servidor desde donde se extraen los datos.
parte del codigo css fue reutilizado  a partir del trabajo de Hendrik Will y su plugin http://imwill.com/wp-google-weather/, thanks Hendrik.

= Features =

* Muestra los principales indicadores economicos para Chile

== Credits ==

Copyright 2009 by Andres Molina

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA


== Installation ==
ENGLISH
1. Unzip and upload files the files to `/wp-content/plugins/indicadores-economicos/`
2. Activate the plugin
3. Go to Themes > Widgets and drag WP Indicadores Ecnomicos widget to your sidebar
4. Specify title

Castellano
1. Descomprime el archivo y subelos a `/wp-content/plugins/indicadores-economicos/`
2. Activa el plugin
3. Ve a Apariencia > Widgets y arrastra el widget Indicadores Economicos CL widget a tu sidebar
4. Especifica un titulo

== Screenshots ==

1. Widget options / opciones del Widget
2. Frontend view / Vista del Front End, lo que el usuario final vera


== Frequently Asked Questions ==

Feel free to ask!

Q: En mi servidor no funciona, porque pasa esto?
A: Asegurate de tener la ultima version de Wordpress, tambien asegurate que tu servidor permita hacer conecciones por sockets, y que la funcion file_get_contents este habilitada

= 2.0 - 24.06.2010  =
* Version 2.0 With Local cache
* Ahora Guarda los datos en base de datos, de este modo no obtendremos errores por problemas de coneccion al servidor que ofrece los indicadores economicos.
 
= 1.0 - 30.11.2009  =
* initial release

== Todos ==
English
* add admin_notices after install, direct link to widget page
* add translation for backend
* choose from different styles
 

Spanish

* agregar admin_notices luego de la instalacion, enlace directo a la pagina de widgets
* Agregar Soporte para indicadores economicos de otros paises y traduccion para el backend de ser necesario
* Poder seleccionar distintas hojas de estilo
 