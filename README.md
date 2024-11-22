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
c) Se se loguea correctamente


# Melloras
+ Habilitar a opción no login de cambiar a contrasinal por se o cliente non a lembra.
+ Á hora de que un cliente (empresa) rexistre un dominio, se comprobe que lle pertence dito dominio.
+ Posibilidade de que o cliente suba a chave pública (csr) en lugar de xeralo na "nube". 
  
