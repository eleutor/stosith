# Stosith - Xestión de Certificados Dixitais
Este proxecto pretende facilitar a xestión de certificados dixitais de uso interno para un dominio.
O propietario de un dominio poderá rexistrase e emitir e xestionar certificados electrónicos de uso interno 
(xa que non somos unha entidade de rexistro legalmente recoñecida)

Permite expedir certificados electrónicos para:
- Cifrado e Firma de e-mail
- Autenticación de usuarios en servizos online
- Creación de tarxetas de identificación para acceso e uso de equipamento 
- Establecemento de servizos seguros (https)

O cliente (propietario do dominio) poderá:
- Obter un certificado
- Ver os seus certificados
- Renovar un certificado
- Revocar un certificado

## Casos de Uso
+ Un cliente se rexistra (Alta dun cliente/empresa. Simplemente se lle facilitan as credenciais de acceso, pero para poder operar necesita engadir dominios)
+ Un cliente inicia sesión
+ Un cliente engade un dominio
+ Un cliente lista os seus certificados
+ Un cliente crea un certificado para un dominio
+ Un cliente revoca un certificado dun dominio
+ Un cliente renova un certificado dun dominio
+ Un cliente descarga un certificado
+ Un cliente descarga a chave privada dun certificado

### Un cliente se rexistra
a) Se amosa un formulario pedindo os seguientes datos:
+ NIF PK NN
+ Nome da empresa NN
+ Email NN
+ Dirección NN
+ Teléfono N
+ Contrasinal (poñela dúas veces)
b) Compróbase que os datos sexan introducidos correctamente, se é así enviarase ó login automaticamente senón amosarase os erros respectivos.

### Un cliente inicia sesión
a) Amósase un mensaxe de benvida xunto cun login onde porá o seu NIF e a súa contrasinal. Comprobaremos os datos introducidos e enviados polo cliente, amosando diferentes mensaxes de erro dependendo de se se equivocou co NIF, coa contrasinal ou ambas.
+ Erro NIF: O NIF introducido é incorrecto ou non está rexistrado.
+ Erro Contrasinal: A contrasinal introducida é incorrecta, ténteo de novo.
b) Enlace para rexistrarse por se o cliente accede ao login sen rexistrarse previamente.
c) Se se loguea correctamente amosarase de inicio, a lista de dominios ou dominio(no caso de que se acabase de rexistrar indicarase unha mensaxe conforme non ten ningún e terá un botón no cal poderá engadir un) e unha barra de navegación con diferentes opcións: perfíl, dominios, certificados vixentes (actual), certificados revocados...

### Un cliente engade un dominio
a) Ao clicar no botón "engadir dominio" desplegarase unha ventana emerxente na cal introducirá o dominio a engadir. Se os datos introducidos son correctos, engadiráselle o dominio e volverá á paxina inicial, pero esta vez apareceralle este a máis.

### Un cliente lista os seus certificados
a) Unha vez que teña un ou varios dominios rexistrados ao clicar nestes amosaranse os respectivos certificados que teña con cada un xunto cun indicativo de se están vixentes o revocados
b) Ao clicar nun dominio tamén haberá un botón onde se lle indique que pode xerar un novo certificado, o cal desplegará unha ventana onde terá que indicar o tipo de certificado a crear xunto cos datos requeridos según a opción que elixa. 
c) Unha vez cuberto o formulario verificarase que os datos son correctos volverá a cargar a páxina do dominio pero esta vez aparecerá o certificado xerado coa opción de descargalo, descargar a chave privada, renovalo e a opción de poder revocalo.

### Un cliente revoca un certificado dun dominio
a) Cando preme nun dominio e lista todos os certificados, co seu respectivo estado, deste, nos certificados vixentes terá activa a opción de revocalos. Se selecciona esa opción saltará unha alerta para que confirme de que quere revocalo, se confirma o estado do certificado pasará a indicarse como revocado e xa non terá validez.

### Un cliente renova un certificado dun dominio
a) Os certificados ao xerarse asínaselle unha fecha de caducidade (distinta según o tipo de certificado) a cal ao vencer, indicará no estado "RENOVAR" para que o cliente se o renove. Deberá premer no boton de renovar e rexenarase un novo certificado pa o mesmo asunto automaticamente.

### Un cliente descarga un certificado
a) Se un certificado está en vigor, terá dispoñible un botón coa opción de descargalo. O cliente só terá que premer o botón e iniciarase a descarga do certificado.

### Un cliente descarga a chave privada dun certificado
a) Se un certificado está en vigor, terá dispoñible un botón coa opción de descargarla, ao lado do botón de descarga do certificado. O cliente só terá que premer o botón e iniciarase a descarga da chave privada.

## Base de datos

#### Cliente
+ COD_Client PK
+ NameClient
+ Email
+ Address


#### Dominios
+ COD_Dom PK
+ NameDom NN

#### Certificados
+ COD_Cert PK
+ NameCert NN
+ Type (e-mail, usuario, tarjeta identificativa, server)
+ State (en vigor, revocado, renovar)
+ COD_Dom FK
    







# Melloras
+ Habilitar a opción no login de cambiar a contrasinal por se o cliente non a lembra.
+ Á hora de que un cliente (empresa) rexistre un dominio, se comprobe que lle pertence dito dominio.
+ Posibilidade de que o cliente suba a chave pública (csr) en lugar de xeralo na "nube". 
  