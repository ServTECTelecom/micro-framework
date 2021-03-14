## Adaptação do TJG Micro Framework 0.0.1 Alpha
- Adicionado sistema de migration/seed [Phinx](https://book.cakephp.org/phinx/0/en/index.html)
  
  `vendor/bin/phinx create UsersMigration`
  
  `vendor/bin/phinx migrate -e development`
  
  `vendor/bin/phinx rollback -e development`
  
- Substituido o Validator pelo do pacote Illuminate do Laravel




## TJG Micro Framework 0.0.1 Alpha
Este é um micro framework MVC em PHP, construído como execício do conteúdo didático do curso "Micro Framework do Zero" disponibilizado através do Youtube no canal [TJG Web](https://www.youtube.com/playlist?list=PLSYIyzca1f9wGynWlC-SH2lVBkE8S81A0).

O intúito do curso é dar uma base mais sólida e exclarecer os conceitos e o funcionamento do ciclo de vida de uma aplicação web seguindo padrões MVC. Depois deste curso, o aluno entenderá melhor o conteúdo de outros cursos oferecidos na internet de frameworks como Laravel, Zend, CakePHP, etc.

### Instalação:
##### Através do composer:
`composer create-project tjg/microframework nome_projeto`


### License

The TJG Micro Framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
