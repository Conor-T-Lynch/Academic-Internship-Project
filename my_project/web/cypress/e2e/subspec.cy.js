describe('Login and Subscription Form Test', () => {
  it('should login and subscribe', () => {
    //Visit the login page
    cy.visit('http://localhost:8080/index.html');

    //Fill in the login form
    cy.get('input[name="username"]').type('Conor1');
    cy.get('input[name="password"]').type('Conz104');

    //Submit the login form
    cy.get('form').submit();

    //Wait for successful login and redirection to the welcome page
    cy.url().should('include', '/welcome');
    cy.contains('Welcome, Conor1').should('be.visible');

    //Visit the subscription page
    cy.visit('http://localhost:8080/subscription.php');

    //Wait for the subscription form to be visible
    cy.get('#subscription-form', { timeout: 10000 }).should('be.visible');

    //Fill in the subscription form with card details
    cy.get('select[name="plan"]').select('monthly');
    //Example card number
    cy.get('input[name="card_number"]').type('4572349468013789');
    cy.get('input[name="expiry_date"]').type('12/25');
    cy.get('input[name="cvc"]').type('123');

    //Submit the subscription form
    cy.get('#subscription-form').submit();

  });
  
});
