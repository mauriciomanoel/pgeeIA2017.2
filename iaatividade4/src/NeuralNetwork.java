// http://viceroy.eeb.uconn.edu/estimates/EstimateSPages/EstSUsersGuide/References/WaltherAndMoore2005.pdf
// https://stackoverflow.com/questions/26442875/measuring-performance-by-mse-or-rmse-in-classification-clustering-tasks

public class NeuralNetwork {

private Layer[] layers;
	
	public NeuralNetwork(int inputSize, int hiddenSize, int outputSize) {
		layers = new Layer[2];
		layers[0] = new Layer(inputSize, hiddenSize);
		layers[1] = new Layer(hiddenSize, outputSize);
	}

	public Layer getLayer(int index) {
		return layers[index];
	}

	// Function of activate 
	public float[] run(float[] input) {
		float[] inputActivation = input;
		for (int i = 0; i < layers.length; i++) {
			inputActivation = layers[i].run(inputActivation);
		}
		return inputActivation;
	}

	// Function of Training Network 
	public void train(float[] input, float[] targetOutput, float learningRate, float momentum) {
		
		float[] calculatedOutput = run(input);
		// one dimensional array for calculate error
		float[] error = new float[calculatedOutput.length];
				
		for (int i = 0; i < error.length; i++) {
			error[i] = targetOutput[i] - calculatedOutput[i]; // calculate rate of error
		}
		// from layer internal to external
		for (int i = layers.length - 1; i >= 0; i--) {			
			error = layers[i].train(error, learningRate, momentum); // new train with new error
		}
	}
}
