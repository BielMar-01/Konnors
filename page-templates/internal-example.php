<?php /* Template Name: DEV - Internal Example */ ?>
<?php
    get_header();
    get_template_part('partials/content', 'top');
?>

    <section class="wpContent--text">
        <div class="container">     
            <h2>
                H2 ou Subtítulo Interno
            </h2>
            <h4>
                H4 ou título de arquivo e separação interna
            </h4>

            <p>
                O texto interno disponibilizado nas páginas internas foi feito com base nas formatações encontradas no Manual da Marca e no Website Institucional. <br>
                Desse modo, garantimos que o usuário sinta que está em ambientes integrados, que conversam um com o outro. 
            </p>
            <p>
                A área interna de digitação em dimensões grandes, acima de 1366px de largura, corresponde à 960px aproximadamente, enquanto que em resoluções menores estes valores se adaptarão de modo responsivo para manter a relação de espaço nas laterais. A linguagem do website precisa ser simples, leve e de fácil compreensão. Isso torna o conteúdo do website universal. 
            </p>

            <a href="a">
                Exemplo de Link
            </a>

            <ul>
                <li>
                    Exemplo de Bullet
                </li>
                <li>
                    Exemplo de Bullet
                </li>
            </ul>
        </div>
    </section>

    <section class="wpContent--hlArea hlArea">
        <div class="container">
            <h5>
                H5 Destaque
            </h5>
            <h3>
                H3 ou exemplo de destaque
            </h3>
            <p>
                Esta região de formatação especial serve para destacar um conteúdo e pode haver ou não uma imagem. 
            </p>
            <p>
                É perfeita para colocar resultados, destaques ou
                valores prioritários.  Também é perfeita para citações.
            </p>
        </div>
    </section>

    <section class="wpContent--faqs accordion">
        <div class="container">
            <div class="accordion__item">
                <div class="accordion__item__header js-trigger-accordion">
                    Conteúdo em abre-fecha que serve para esconder ou diminuir o conteúdo da página
                </div>

                <div class="accordion__item__content">
                    <p>
                        Este conteúdo poderia estar escondido para deixar a área de conteúdo da página menor.  
                    </p>
                    <p>
                        Caso seja do interesse do investidor ou leitor acessando o werbsite, é possível clicar na seta de ver mais e ler o conteúdo escrito aqui. <br>
                        A formatação desse recurso é muito simples e disponibilizada pelo website builder. 
                    </p>
                </div>
            </div>
            <div class="accordion__item">
                <div class="accordion__item__header js-trigger-accordion">
                    Conteúdo em abre-fecha que serve para esconder ou diminuir o conteúdo da página
                </div>

                <div class="accordion__item__content">
                    <p>
                        Este conteúdo poderia estar escondido para deixar a área de conteúdo da página menor.  
                    </p>
                    <p>
                        Caso seja do interesse do investidor ou leitor acessando o werbsite, é possível clicar na seta de ver mais e ler o conteúdo escrito aqui. <br>
                        A formatação desse recurso é muito simples e disponibilizada pelo website builder. 
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="wpContent--text">
        <div class="container">     
            <table>
                <thead>
                    <tr>
                        <th scope="col">Coluna 1</th>
                        <th scope="col">Coluna 2</th>
                        <th scope="col">Coluna 3</th>
                        <th scope="col">Coluna 4</th>
                        <th scope="col">Coluna 5</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="col">Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                        <td scope="col">Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                        <td scope="col">Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                        <td scope="col">Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                        <td scope="col">Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                    </tr>
                    <tr>
                        <td scope="col">Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                        <td scope="col">Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                        <td scope="col">Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                        <td scope="col">Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                        <td scope="col">Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                    </tr>
                    <tr>
                        <td scope="col">Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                        <td scope="col">Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                        <td scope="col">Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                        <td scope="col">Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                        <td scope="col">Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

<?php
    get_template_part('partials/content', 'bottom');
    get_footer();
?>