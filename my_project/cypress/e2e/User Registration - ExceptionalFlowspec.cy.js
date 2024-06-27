//@Reference:https://learn.cypress.io/testing-your-first-application/how-to-test-forms-and-custom-cypress-commands (accessed Jul. 22, 2024).
describe('User Registration - Exceptional Flow', () => {
  it('should show error for mismatched passwords', () => {
    //Visit the registration page
    cy.visit('http://localhost:8080/register.html');
     //Fill in the form fields
    cy.get('input[name="email"]').type('testuser2@example.com');
    cy.get('input[name="username"]').type('testuser2');
    cy.get('input[name="password"]').type('password123');
    cy.get('input[name="confirm_password"]').type('differentpassword');
    //Submit the form
    cy.get('form').submit();
     //Verify the success message
    cy.contains('Passwords do not match').should('be.visible');
  });
});
