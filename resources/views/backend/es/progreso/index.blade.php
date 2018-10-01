@extends('layouts.adminlte.app')

@section('banner')
  @include('backend.partials.bannertop')
@endsection

@section('content')

<div class="container">

  <div class="row">
    <div class="col-md-3">
      @include('backend.partials.navuser')

      @include('backend.partials.navoptions')
    </div>

    <div class="col-md-9" style='padding-top:70px;'>
      <div class="row">
            @include('backend.partials.tabcontent') 
      </div>

      <h4>Modulo 1</h4>
      <div id="accordion">
        <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
        <div class="card ">
          <div class="card-header">
            <h4 class="card-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#colapse1" class="collapsed" aria-expanded="false">
                Leccion 1
              </a>
              <small class="badge badge-primary float-right"><i class="fa fa-clock-o"></i> 30 minutos</small>
            </h4>
          </div>
          <div id="colapse1" class="panel-collapse in collapse" style="">
            <div class="card-body">
              os plugins de WordPress son piezas de software que pueden ser cargados para extender y expandir la funcionabilidad de tu sitio WordPress.<br><br>

<b>Nota: Una de las principales ventajas de usar una versión self-hosted de WordPress de WordPress.org es la habilidad de cargar y usar plugins en tu sitio WordPress.</b><br><br>

Ya que WordPress es un software de código abierto, todas estas son herramientas de terceros que complementan lo que WordPress puede hacer.<br><br>

Son fáciles de descargar e instalar. Algunos son Premium (hay un coste para comprarlos) y otros son gratuitos.<br><br>

Los plugins pueden hacer cosas como mejorar la optimización de tus motores de búsqueda, mostrar posts relacionados en tu barra lateral, hacer respaldos completos de tu sitio WordPress (por ejemplo con Akeeba Backup) o crear increíbles formularios web de manera rápida y sencilla (Gravity Forms).<br><br>

Puedes añadir casi cualquier funcionabilidad a WordPress con los plugins. El directorio de plugins de WordPress es un depósito de plugins gratuitos que han sido (de alguna manera) validados. Actualmente hay más de 40,000 plugins en el directorio de WordPress, así que hay muchas opciones.<br><br>

Plugins de WordPress gratuitos vs Premium
Como mencionamos, hay toneladas de plugins de WordPress disponibles para descargar gratuitamente del directorio de plugins de WordPress.org.<br><br>

También hay plugins de WordPress Premium o de pago.<br><br>

<b>¿Por qué querrías pagar por un plugin? Bueno, hay muchas razones:</b><br><br>

Mientras que hay muchos plugins gratuitos disponibles desde el directorio de plugins, los plugins de pago usualmente ofrecen personal de apoyo de tiempo completo y desarrolladores que trabajan en mantener la seguridad y la compatibilidad de los plugins con la última versión de WordPress, así como también con otros temas y plugins.<br><br>

La mayoría del tiempo, los plugins juegan bien con el nucleo de WordPress y con otros plugins, pero algunas veces el código del plugin puede interferir en el camino de otro plugin, causando problemas de compatibilidad. Con un plugin de pago, es bueno saber que tienes el apoyo de un personal que te puede ayudar en caso de que algo salga mal.<br><br>

Instalar Plugins de WordPress
Intalar plugins en tu sitio WordPress es un proceso simple.<br><br>

Método descargar y subir
Nota: Si estás usando plugins Premium de una fuente de terceros, usualmente vienen como archivos .zip. Vas a necesitar usar el método descargar y subir para instalar el archivo zip en tu sitio.<br><br>

Para instalar un plugin en tu sitio WordPress, localiza el menú Plugin después de iniciar sesión al dashboard WordPress de tu sitio. Expande este menú.<br><br>

Para subir un nuevo plugin, haz clic en el link Add New.<br><br>

Haz clic en el botón Upload Plugin, localiza el archivo zip de tu plugin y luego haz clic en Install Now. Después, haz clic en Activate.<br><br>

El primer plugin que recomendamos subir es Akeeba Backup. Este plugin hace una copia de seguridad de toda la instalación de tu sitio WordPress, para que siempre tengas un plan de respaldo por si tu sitio se “estropea”, es hackeado o si “rompes” algo y quieres regresar a una versión anterior del sitio.<br><br>

Método buscar e instalar
También tienes la opción de buscar plugins para instalarlos desde el directorio de plugins de WordPress.org, directamente desde la página Add New. Haz clic en las pestañas de esta página para ver los plugins destacados, populares y nuevos que has marcado como favoritos.<br><br>

Usa la barra de búsqueda para buscar el plugin de tu elección.<br><br>

Haz clic en el botón Install Now.<br><br>

Una vez que el plugin esté instalado, sólo haz clic en Activate.<br><br>

Método manual de instalación
También puedes añadir plugins manualmente y subirlos con software FTP. Esto es más complicado y no es para el usuario novato. Necesitas descargar el archivo del plugin a tu computadora y descomprimirlo. Esto te dará una carpeta en tu computadora con todos los archivos del plugin. Luego, usando un programa FTP, sube la carpeta del plugin a la carpeta wp-content/plugins de tu sitio. Después ve a la pantalla de Plugins y puedes encontrar tu nuevo plugin en la lista. Haz clic en ‘Activate’ para empezar.<br><br>

Más opciones del menú de plugins
En la página Installed Plugins, verás una lista de todos los plugins que se encuentran instalados en tu sitio. Algunos plugins vienen incluidos con tu instalación de WordPress, como Akismet, un plugin que protege tu blog de comentarios y trackback spam, y Jetpack, una manera de conectar tu blog a una cuenta WordPress.com y activar características adicionales.<br><br>

La última opción del menú debajo de plugins en el dashboard de WordPress es el Editor. El plugin de editor integrado de WordPress puede usarse para hacer cambios a cualquier archivo PHP individual del plugin. Sólo ten en cuenta que si haces un cambio, las actualizaciones del plugin van a sobrescribir tus personalizaciones, Así que, a menos que conozcas PHP, probablemente no quieras editar nada del código PHP del plugin.
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-outline-primary btn-sm">Finalizar</button>
            </div>
          </div>
        </div>
      </div>
      <div id="accordion">
        <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
        <div class="card ">
          <div class="card-header">
            <h4 class="card-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#colapse2" class="collapsed" aria-expanded="false">
                Leccion 2
              </a>
              <small class="badge badge-primary float-right"><i class="fa fa-clock-o"></i> 15 minutos</small>
            </h4>
          </div>
          <div id="colapse2" class="panel-collapse in collapse" style="">
            <div class="card-body">

              los plugins de WordPress son piezas de software que pueden ser cargados para extender y expandir la funcionabilidad de tu sitio WordPress.<br><br>

  <b>Nota: Una de las principales ventajas de usar una versión self-hosted de WordPress de WordPress.org es la habilidad de cargar y usar plugins en tu sitio WordPress.</b><br><br>

  Ya que WordPress es un software de código abierto, todas estas son herramientas de terceros que complementan lo que WordPress puede hacer.<br><br>

  Son fáciles de descargar e instalar. Algunos son Premium (hay un coste para comprarlos) y otros son gratuitos.<br><br>

  Los plugins pueden hacer cosas como mejorar la optimización de tus motores de búsqueda, mostrar posts relacionados en tu barra lateral, hacer respaldos completos de tu sitio WordPress (por ejemplo con Akeeba Backup) o crear increíbles formularios web de manera rápida y sencilla (Gravity Forms).<br><br>

  Puedes añadir casi cualquier funcionabilidad a WordPress con los plugins. El directorio de plugins de WordPress es un depósito de plugins gratuitos que han sido (de alguna manera) validados. Actualmente hay más de 40,000 plugins en el directorio de WordPress, así que hay muchas opciones.<br><br>

  Plugins de WordPress gratuitos vs Premium
  Como mencionamos, hay toneladas de plugins de WordPress disponibles para descargar gratuitamente del directorio de plugins de WordPress.org.<br><br>

  También hay plugins de WordPress Premium o de pago.<br><br>

  <b>¿Por qué querrías pagar por un plugin? Bueno, hay muchas razones:</b><br><br>

  Mientras que hay muchos plugins gratuitos disponibles desde el directorio de plugins, los plugins de pago usualmente ofrecen personal de apoyo de tiempo completo y desarrolladores que trabajan en mantener la seguridad y la compatibilidad de los plugins con la última versión de WordPress, así como también con otros temas y plugins.<br><br>

  La mayoría del tiempo, los plugins juegan bien con el nucleo de WordPress y con otros plugins, pero algunas veces el código del plugin puede interferir en el camino de otro plugin, causando problemas de compatibilidad. Con un plugin de pago, es bueno saber que tienes el apoyo de un personal que te puede ayudar en caso de que algo salga mal.<br><br>

  Instalar Plugins de WordPress
  Intalar plugins en tu sitio WordPress es un proceso simple.<br><br>

  Método descargar y subir
  Nota: Si estás usando plugins Premium de una fuente de terceros, usualmente vienen como archivos .zip. Vas a necesitar usar el método descargar y subir para instalar el archivo zip en tu sitio.<br><br>

  Para instalar un plugin en tu sitio WordPress, localiza el menú Plugin después de iniciar sesión al dashboard WordPress de tu sitio. Expande este menú.<br><br>

  Para subir un nuevo plugin, haz clic en el link Add New.<br><br>

  Haz clic en el botón Upload Plugin, localiza el archivo zip de tu plugin y luego haz clic en Install Now. Después, haz clic en Activate.<br><br>

  El primer plugin que recomendamos subir es Akeeba Backup. Este plugin hace una copia de seguridad de toda la instalación de tu sitio WordPress, para que siempre tengas un plan de respaldo por si tu sitio se “estropea”, es hackeado o si “rompes” algo y quieres regresar a una versión anterior del sitio.<br><br>

  Método buscar e instalar
  También tienes la opción de buscar plugins para instalarlos desde el directorio de plugins de WordPress.org, directamente desde la página Add New. Haz clic en las pestañas de esta página para ver los plugins destacados, populares y nuevos que has marcado como favoritos.<br><br>

  Usa la barra de búsqueda para buscar el plugin de tu elección.<br><br>

  Haz clic en el botón Install Now.<br><br>

  Una vez que el plugin esté instalado, sólo haz clic en Activate.<br><br>

  Método manual de instalación
  También puedes añadir plugins manualmente y subirlos con software FTP. Esto es más complicado y no es para el usuario novato. Necesitas descargar el archivo del plugin a tu computadora y descomprimirlo. Esto te dará una carpeta en tu computadora con todos los archivos del plugin. Luego, usando un programa FTP, sube la carpeta del plugin a la carpeta wp-content/plugins de tu sitio. Después ve a la pantalla de Plugins y puedes encontrar tu nuevo plugin en la lista. Haz clic en ‘Activate’ para empezar.<br><br>

  Más opciones del menú de plugins
  En la página Installed Plugins, verás una lista de todos los plugins que se encuentran instalados en tu sitio. Algunos plugins vienen incluidos con tu instalación de WordPress, como Akismet, un plugin que protege tu blog de comentarios y trackback spam, y Jetpack, una manera de conectar tu blog a una cuenta WordPress.com y activar características adicionales.<br><br>

  La última opción del menú debajo de plugins en el dashboard de WordPress es el Editor. El plugin de editor integrado de WordPress puede usarse para hacer cambios a cualquier archivo PHP individual del plugin. Sólo ten en cuenta que si haces un cambio, las actualizaciones del plugin van a sobrescribir tus personalizaciones, Así que, a menos que conozcas PHP, probablemente no quieras editar nada del código PHP del plugin.
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-outline-primary btn-sm">Finalizar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
@parent

@stop
