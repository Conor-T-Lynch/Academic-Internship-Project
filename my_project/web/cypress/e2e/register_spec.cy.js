//@Reference:https://learn.cypress.io/testing-your-first-application/how-to-test-forms-and-custom-cypress-commands (accessed Jul. 22, 2024).
describe('Registration Form Test', () => {
  it('should fill in the registration form and submit', () => {
    //Visit the registration page
    cy.visit('http://localhost:8080/register.html');

    //Fill in the form fields
    cy.get('input[name="email"]').type('ctlync89@live.com');
    cy.get('input[name="username"]').type('Conor1');
    cy.get('input[name="password"]').type('Conz104');
    cy.get('input[name="confirm_password"]').type('Conz104');

    //Submit the form
    cy.get('#register-form').submit();

    //Verify the success message
    cy.get('.success-message', { timeout: 10000 }).should('be.visible').and('contain', 'Registration successful');
  });
});
