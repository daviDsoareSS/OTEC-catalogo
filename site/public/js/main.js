
const buttonSidebar = document.querySelector('.ocult-sidebar');
const buttonOpenSidebar = document.querySelector('.openSidebar');
const buttonCloseSidebar = document.querySelector('.closeSidebar');
const btnCloseSidebar = document.querySelector('.btnCloseSidebar')
const sidebar = document.querySelector('.sidebar');
const mainContent = document.querySelector('main');


btnCloseSidebar.addEventListener('click', function(){
  sidebar.classList.remove('mobile')
})

function hoverSidebar() {
  sidebar.addEventListener('mouseover', function() {
    buttonOpenSidebar.style.display = 'none';
    buttonCloseSidebar.style.display = 'block';
    sidebar.classList.remove('active');
  });

  sidebar.addEventListener('mouseleave', function(event) {
    buttonOpenSidebar.style.display = 'block';
    buttonCloseSidebar.style.display = 'none';
    sidebar.classList.add('active');
      const linksCollapse = document.querySelectorAll('.icons-sidebar-expanded .collapse');
      linksCollapse.forEach(function(link) {
        link.classList.remove('show');
      });
    }
)}

hoverSidebar()


// MENU-MOBILE
const btnMobile = document.querySelector('.btnMobile')

btnMobile.addEventListener('click', function(){
    sidebar.classList.toggle('mobile')
    hoverSidebar = function() {};
    hoverSidebar = function() {};
    sidebar.classList.remove('active')
})
buttonCloseSidebar.addEventListener('click', function(){
    sidebar.classList.remove('mobile')
})




// MENU-MOBILE


//CHANGE COLOR BODY
// Verifica a preferência de tema no localStorage e define o tema correspondente
document.body.classList.toggle('dark', localStorage.getItem('theme') === 'dark');

// Adiciona um ouvinte de evento para alternar o tema quando o botão for clicado
document.querySelector('.dark-mode-toggle').addEventListener('click', () => {
  // Alterna a classe 'dark-mode' no corpo do documento
  document.body.classList.toggle('dark');

  // Atualiza a preferência de tema no localStorage
  localStorage.setItem('theme', document.body.classList.contains('dark') ? 'dark' : 'light');
});
document.querySelector('.white-mode-toggle').addEventListener('click', () => {
  // Alterna a classe 'dark-mode' no corpo do documento
  document.body.classList.remove('dark');

  // Atualiza a preferência de tema no localStorage
  localStorage.setItem('theme', document.body.classList.contains('dark') ? '' : 'light');
});


//Mudar cor do header ao dar scroll ná pagina
const header = document.querySelector('header')

function changeHeaderColor() {
    // Obter a posição atual do scroll
    const scrollPosition = window.pageYOffset;

    // Verificar se a posição do scroll ultrapassou a posição inicial da navbar
    if (scrollPosition >= 80) {
        // Mudar a cor da navbar
      header.classList.add('scrolled');
    } else {
        // Restaurar a cor padrão da navbar
        header.classList.remove('scrolled');
    }
}
window.addEventListener('scroll', changeHeaderColor)

//Fim - Mudar cor do header ao dar scroll ná pagina



