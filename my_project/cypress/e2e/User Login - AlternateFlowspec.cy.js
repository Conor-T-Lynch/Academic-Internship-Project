//@Reference:https://learn.cypress.io/testing-your-first-application/how-to-test-forms-and-custom-cypress-commands (accessed Jul. 22, 2024).
describe('User Login - Alternate Flow', () => {
  it('should show error for incorrect password', () => {
    //Visit the login page
    cy.visit('http://localhost:8080/index.html');
    //Fill in the form fields
    cy.get('input[name="username"]').type('testuser');
    cy.get('input[name="password"]').type('wrongpassword');
    //Submit the form
    cy.get('form').submit();
    //message should be visible
    cy.contains('Invalid username or password').should('be.visible');
  });
});
