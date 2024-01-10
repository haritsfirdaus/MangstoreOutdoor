import httpClient from './httpClient';

export default class Posts {
  static getLatestPosts() {
    return httpClient.get('/posts/latest');
  }

}