import api from './index'
import Config from '@/config/app'

const {
  http,
  index,
  store,
  update
} = api

/**
 * ===================
 * User API
 * ===================
 */
export default {
  baseUrl: `${Config.services.api.url}/api`,
  url: 'users',
  http,
  index,
  store,
  update,

  /**
   * Remove the specified resource from storage.
   *
   */
  destroy (params = null) {
    return this.http(this.baseUrl)
      .delete(this.url, { params })
  }
}
