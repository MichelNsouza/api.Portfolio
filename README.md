# Gerenciador de Portfolio - BackEnd

## Sobre o Projeto
O projeto trata-se de uma api Restful que gerencia os projetos de meu proprio portfolio :)

## Tecnologias Utilizadas no Back-end
- Laravel: Deploy no vercel
- MySql: FreeHostia

## Endpoints

Esta é uma API RESTful e no momento, não há autenticação via token, portanto, você pode realizar as requisições diretamente para os seguintes endpoints:

**Base URL:** `https://api-portfolio-michel-souza.vercel.app/api/api`  
(Note que o caminho inclui `/api/api` devido à configuração no Vercel rsrs.)

Modelo Json:
     
```json
{
  "titulo": "Titulo do projeto",
  "descricao": "Descrição do projeto",
  "tecnologias": "Tecnologias presente no projeto",
  "linkCodigoFonte": "github.com/xpto",
  "linkDeploy": "projetoXPTO.com",
  "CaminhoImagem": "enviar a imagem no corpo, onde a aplicação realiza o tratamento e retorna a caminho",
}
```

### Métodos e Rotas

1. **Listar todos os projetos**
   - **Método:** `GET`
   - **Rota:** `/projetos`
   - **Descrição:** Recupera uma lista de todos os projetos.

2. **Criar um novo projeto**
   - **Método:** `POST`
   - **Rota:** `/projetos`
   - **Descrição:** Cria um novo projeto. É necessário enviar os dados do projeto no corpo da requisição.

3. **Mostrar um projeto específico**
   - **Método:** `GET`
   - **Rota:** `/projetos/{projeto_id}`
   - **Descrição:** Recupera as informações de um projeto específico baseado no `projeto_id`.

4. **Atualizar um projeto específico**
   - **Método:** `PUT` ou `PATCH`
   - **Rota:** `/projetos/{projeto_id}`
   - **Descrição:** Atualiza um projeto específico baseado no `projeto_id`. Os dados atualizados devem ser enviados no corpo da requisição.

5. **Excluir um projeto específico**
   - **Método:** `DELETE`
   - **Rota:** `/projetos/{projeto_id}`
   - **Descrição:** Remove um projeto específico baseado no `projeto_id`.


## Front-end
- VueJs Deploy no vercel
    - BootStrap
    - Pinia - gerenciamento de estado
    - Vue-Router - Roteamento baseado em componente
    - Axios -  Cliente HTTP 
    - Vite -  Pré-empacotamento de dependência

O código-fonte do Front-end associado a este projeto pode ser encontrado no seguinte repositório do GitHub: [Front-End gerenciador de Portfolio](https://github.com/MichelNsouza/front.Portfolio).

### Imagens
![image](https://github.com/user-attachments/assets/3e042130-921d-446e-ab06-fee3d9d4d71b)



## License
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
