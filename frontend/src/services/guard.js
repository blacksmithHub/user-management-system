import AuthService from '@/services/auth'

/**
 * =======================================
 * Route Guards
 * =======================================
 */
export default {
  /**
   * Route guard for protected endpoints.
   *
   * @param next
   * @return next
   */
  async authorized (next) {
    // Proceed to login page if the user is unauthenticated
    if (!AuthService.isAuthenticated()) {
      AuthService.flush()
      return next({ name: 'Login' })
    }

    // Attempt to refresh token if token is expired
    if (AuthService.isAccessTokenExpired()) {
      await AuthService.refreshToken()
        .then(({ data }) => AuthService.setAuth(data))
        .catch(() => {
          AuthService.flush()
          return next({ name: 'Login' })
        })
    }

    // If user is authenticated, verify the access token
    AuthService.verifyAccessToken()
      .then(async ({ data }) => {
        AuthService.setUser(data)
        return next()
      })
      .catch(() => {
        AuthService.flush()
        return next({ name: 'Login' })
      })
  },
  /**
   * Route Guard for login endpoint
   *
   * @param {*} from
   * @param {*} next
   * @return next
   */
  async login (from, next) {
    /**
     * When user still authenticated and access_token is not expired retain current route
     */
    if (AuthService.isAuthenticated() && !AuthService.isAccessTokenExpired()) {
      return next(from.path)
    }

    AuthService.flush()
    return next()
  }
}
