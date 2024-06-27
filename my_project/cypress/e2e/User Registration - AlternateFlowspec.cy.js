//@Reference:https://learn.cypress.io/testing-your-first-application/how-to-test-forms-and-custom-cypress-commands (accessed Jul. 22, 2024).
describe('User Registration - Alternate Flow', () => {
  it('should not register with already taken username', () => {
    //Visit the registration page
    cy.visit('http://localhost:8080/register.html');
    //Fill in the form fields
    cy.get('input[name="email"]').type('testuser@example.com');
    cy.get('input[name="username"]').type('testuser');
    cy.get('input[name="password"]').type('password123');
    cy.get('input[name="confirm_password"]').type('password123');
    //Submit the form
    cy.get('form').submit();
    //Verify the success message
    cy.contains('Username already exists').should('be.visible');
  });
});