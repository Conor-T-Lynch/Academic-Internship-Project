//@Reference:https://learn.cypress.io/testing-your-first-application/how-to-test-forms-and-custom-cypress-commands (accessed Jul. 22, 2024).
describe('User Login - Normal Flow', () => {
  it('should login successfully', () => {
    //Visit the login page
    cy.visit('http://localhost:8080/index.html');
    //Fill in the form fields
    cy.get('input[name="username"]').type('testuser');
    cy.get('input[name="password"]').type('password123');
    //Submit the form
    cy.get('form').submit();
    //Verify the successful login
    cy.url().should('include', '/welcome');
    cy.contains('Welcome, testuser').should('be.visible');
  });
});
