import { CapacitorConfig } from '@capacitor/cli';

const config: CapacitorConfig = {
  appId: 'com.examplatform.app',
  appName: 'IT认证刷题',
  webDir: 'www',
  server: {
    androidScheme: 'https'
  }
};

export default config;
