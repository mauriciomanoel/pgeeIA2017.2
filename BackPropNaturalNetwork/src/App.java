// https://ujjwalkarn.me/2016/08/09/quick-intro-neural-networks/

public class App {

	// Example BackPropagation of Logical Operators AND
	public static void main(String[] args) throws Exception {
		float[] t;
		float[][] trainingData = new float[][] { 
				new float[] { 0, 0 }, 
				new float[] { 0, 1 }, 
				new float[] { 1, 0 },
				new float[] { 1, 1 } 
		};

		float[][] trainingResults = new float[][] {
				new float[] { 0 }, 
				new float[] { 0 }, 
				new float[] { 0 },
				new float[] { 1 } 
		};

		// Init 
		BackpropNeuralNetwork backpropagationNeuralNetworks = new BackpropNeuralNetwork(2, 3, 1);
		
		// Treining network
		for (int iterations = 0; iterations < Constants.ITERATIONS; iterations++) {
			for (int i = 0; i < trainingResults.length; i++) {
				backpropagationNeuralNetworks.train(trainingData[i], trainingResults[i], Constants.LEARNING_RATE, Constants.MOMENTUM);
			}
		}
		
		// Testing the network 
		t = trainingData[0];		
		System.out.printf("%.1f, %.1f --> %.3f\n", t[0], t[1], backpropagationNeuralNetworks.run(t)[0]);
		
		t = trainingData[1];
		System.out.printf("%.1f, %.1f --> %.3f\n", t[0], t[1], backpropagationNeuralNetworks.run(t)[0]);
		
		t = trainingData[2];
		System.out.printf("%.1f, %.1f --> %.3f\n", t[0], t[1], backpropagationNeuralNetworks.run(t)[0]);
		
		t = trainingData[3];
		System.out.printf("%.1f, %.1f --> %.3f\n", t[0], t[1], backpropagationNeuralNetworks.run(t)[0]);
		
	}
}
