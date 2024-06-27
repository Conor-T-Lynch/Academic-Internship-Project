//@Reference:https://learn.cypress.io/testing-your-first-application/how-to-test-forms-and-custom-cypress-commands (accessed Jul. 22, 2024).
describe('Subscription - Alternate Flow', () => {
  it('should allow selecting a different plan', () => {
    //Visit the login page
    cy.visit('http://localhost:8080/index.html');
    //Fill in the login form
    cy.get('input[name="username"]').type('testuser');
    cy.get('input[name="password"]').type('password123');
    //Submit the login form
    cy.get('form').submit();
    //Wait for successful login and redirection to the welcome page
    cy.url().should('include', '/welcome');

    //Visit the subscription page
    cy.visit('http://localhost:8080/subscription.php');
    //Wait for the subscription form to be visible
    cy.get('#subscription-form', { timeout: 10000 }).should('be.visible');
    //subscription form being filled in
    cy.get('select[name="plan"]').select('yearly');
    cy.get('input[name="card_number"]').type('4111111111111111');
    cy.get('input[name="expiry_date"]').type('12/25');
    cy.get('input[name="cvc"]').type('123');
    cy.get('#subscription-form').submit();

    // Wait for the form submission to complete
    cy.wait(5000);
  });
});
