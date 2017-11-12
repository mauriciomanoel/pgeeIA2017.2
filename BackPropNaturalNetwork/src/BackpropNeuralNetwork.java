

public class BackpropNeuralNetwork {

	private Layer[] layers;
	
	public BackpropNeuralNetwork(int inputSize, int hiddenSize, int outputSize) {
		layers = new Layer[2];
		layers[0] = new Layer(inputSize, hiddenSize);
		layers[1] = new Layer(hiddenSize, outputSize);
	}

	public Layer getLayer(int index) {
		return layers[index];
	}

	// Função de activate e auxilia no calculo do erro de acordo com os dados de treinamento 
	// e o que calculamos com a ajuda de nossa própria rede
	public float[] run(float[] input) {
		float[] inputActivation = input;
		for (int i = 0; i < layers.length; i++) {
			inputActivation = layers[i].run(inputActivation);
		}
		return inputActivation;
	}

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
