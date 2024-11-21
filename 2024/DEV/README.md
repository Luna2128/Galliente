# Galliente 1.0

Bienvenido a **Galliente 1.0**, un proyecto diseñado para facilitar el desarrollo y la configuración de entornos modernos de transmisión y administración.

## Ambiente de Desarrollo

Este proyecto requiere que el ambiente de desarrollo esté configurado adecuadamente. A continuación, se describen los pasos y herramientas necesarias.

### **Requisitos**

1. **Windows con WSL (Windows Subsystem for Linux):**
   - Asegúrate de que WSL esté instalado y habilitado.
   - Se recomienda utilizar **Ubuntu** como distribución.

2. **Docker Desktop:**
   - Descarga e instala Docker Desktop desde su sitio oficial.
   - Configura Docker para usar WSL2 como su backend de contenedores.

3. **Habilitar Módulo de Virtualización en BIOS:**
   - Accede a la configuración de tu BIOS.
   - Habilita la opción de **Intel VT-x** o **AMD-V**, dependiendo de tu procesador.
   - Guarda los cambios y reinicia tu máquina.

---

### **Herramientas Recomendadas**

Para trabajar eficientemente en este proyecto, se recomienda el uso de las siguientes herramientas:

1. **Editor de Texto:**
   - Recomendamos **Visual Studio Code** por su flexibilidad y extensiones útiles.

2. **OBS Studio:**
   - Descarga e instala OBS Studio para configuraciones de transmisión y grabación.

3. **WinMerge:**
   - Herramienta gratuita y de código abierto para comparar y fusionar archivos.

4. **Git Extensions:**
   - Proporciona una interfaz gráfica para Git, ideal para gestionar repositorios con facilidad.

---

### **Ejecución del Proyecto con Docker Compose**

El proyecto utiliza Docker Compose para gestionar los servicios. Sigue los pasos a continuación para ejecutar el entorno:

1. **Navegar a la carpeta del proyecto:**
   - Asegúrate de estar en la carpeta donde se encuentra el archivo `docker-compose.yml`. 
   - En este caso, la carpeta se llama `nginx-php`.

     ```bash
     cd nginx-php
     ```

2. **Construir los contenedores:**
   - Ejecuta el siguiente comando para construir las imágenes de Docker especificadas en el archivo `Dockerfile`:

     ```bash
     docker-compose build
     ```

3. **Levantar los servicios:**
   - Inicia los servicios definidos en `docker-compose.yml` ejecutando:

     ```bash
     docker-compose up
     ```

4. **Acceso a los servicios:**
   - Los servicios estarán disponibles en los puertos configurados dentro del archivo `docker-compose.yml`.
   - Por ejemplo, si usas un servidor NGINX, verifica accediendo a `http://localhost`.

5. **Detener los servicios:**
   - Para detener los contenedores en ejecución, usa el siguiente comando:

     ```bash
     docker-compose down
     ```

---

### **Configuración Adicional**

1. **Configuración de WSL:**
   - Ejecuta el siguiente comando para establecer WSL2 como predeterminado:
     ```bash
     wsl --set-default-version 2
     ```
   - Instala la distribución de tu elección (se recomienda Ubuntu) desde la Microsoft Store.

2. **Configuración de Docker Desktop:**
   - Asegúrate de que Docker esté vinculado a WSL2 en las configuraciones avanzadas de Docker Desktop.

3. **Instalación de OBS Studio:**
   - Configura OBS Studio para transmisión o grabación según tus necesidades.

---

¡Estás listo para empezar a trabajar en **Galliente 1.0**! 🚀

Para dudas o problemas, no dudes en consultar la documentación oficial de las herramientas o abrir un issue en este repositorio.
