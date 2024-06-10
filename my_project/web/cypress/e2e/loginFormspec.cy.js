describe('Login Form Test', () => {
  it('should fill in the login form and submit', () => {
    //Visit the login page
    cy.visit('http://localhost:8080/index.html');

    //Fill in the form fields
    cy.get('input[name="username"]').type('Conor1');
    cy.get('input[name="password"]').type('Conz104');

    //Submit the form
    cy.get('form').submit();

    //Verify the successful login
    cy.url().should('include', '/welcome');
    cy.contains('Welcome, Conor1').should('be.visible');
  });
});
